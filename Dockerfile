# ---------------------------------------------------------
# ÉTAPE 1 : BUILD FRONTEND (Node.js)
# ---------------------------------------------------------
FROM node:20-alpine AS frontend

WORKDIR /app

# 1. Copie uniquement les fichiers essentiels pour npm install
COPY package*.json ./
COPY vite.config.js ./

# 2. Copie des dossiers sources nécessaires au build
COPY resources ./resources
COPY public ./public

# 3. Installation et Build (Vite détectera automatiquement tailwind/postcss s'ils existent dans package.json)
RUN npm ci
RUN npm run build

# ---------------------------------------------------------
# ÉTAPE 2 : APPLICATION PHP (Production)
# ---------------------------------------------------------
FROM php:8.4-apache-bookworm

WORKDIR /var/www/html

# Installation des dépendances système
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype \
    && docker-php-ext-install -j$(nproc) pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie du code source Laravel
COPY . .

# COPIE CRUCIALE : Récupération du build généré par l'étape Node
COPY --from=frontend /app/public/build ./public/build

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Configuration Apache
RUN a2enmod rewrite \
    && sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && echo "<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>" >> /etc/apache2/apache2.conf

EXPOSE 80

CMD ["sh", "-c", "php artisan migrate --force && apache2-foreground"]