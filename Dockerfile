# ---------------------------------------------------------
# ÉTAPE 1 : BUILD FRONTEND (Node.js)
# ---------------------------------------------------------
FROM node:20-alpine AS frontend

WORKDIR /app

# Copie des fichiers de dépendances
COPY package*.json ./
COPY vite.config.js ./
COPY tailwind.config.js ./ 2>/dev/null || true
COPY postcss.config.js ./ 2>/dev/null || true

# Copie des sources
COPY resources ./resources
COPY public ./public

# Installation et Build
RUN npm ci
RUN npm run build

# ---------------------------------------------------------
# ÉTAPE 2 : APPLICATION PHP (Production)
# ---------------------------------------------------------
# Utilisation d'une image basée sur Debian Bookworm (plus stable que Trixie parfois)
FROM php:8.4-apache-bookworm

WORKDIR /var/www/html

# Mise à jour sécurisée et installation des paquets système
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

# Copie du code source
COPY . .

# Copie CRUCIALE du build frontend vers le dossier public
COPY --from=frontend /app/public/build ./public/build

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Configuration Apache pour Laravel
RUN a2enmod rewrite \
    && sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && echo "<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>" >> /etc/apache2/apache2.conf

EXPOSE 80

CMD ["sh", "-c", "php artisan migrate --force && apache2-foreground"]