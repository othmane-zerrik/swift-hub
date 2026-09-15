FROM php:8.4-apache

# 1. Installation des dépendances système + Node.js + Extensions PHP
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libzip-dev libpng-dev libonig-dev libicu-dev libxml2-dev \
    libfreetype6-dev libjpeg62-turbo-dev curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_mysql zip intl gd opcache bcmath \
    && a2enmod rewrite \
    # Installation de Node.js 20
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y --no-install-recommends nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Installation de Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 3. Configuration Apache pour pointer vers /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN printf '<Directory /var/www/html/public>\n\tAllowOverride All\n</Directory>\n' > /etc/apache2/conf-available/z-laravel.conf \
    && a2enconf z-laravel
# 4. Copie des fichiers de dépendances d'abord (pour utiliser le cache Docker)
COPY composer.json composer.lock ./
COPY package.json package-lock.json* ./

# 5. Installation des dépendances
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader \
    && npm ci

# 6. Copie de TOUT le code source (y compris resources/, vite.config.js, etc.)
COPY . .

# 7. BUILD VITE (C'est ici que le manifest.json est créé)
RUN npm run build

# 8. Permissions et caches
RUN mkdir -p storage/framework/sessions storage/framework/cache storage/framework/views bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache public/build \
    && chmod -R 775 storage bootstrap/cache \
    && test -f public/build/manifest.json \
    && test -f vendor/autoload.php

ENV PORT=${PORT:-8080}

# 9. Démarrage
CMD sh -c 'sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf && \
    sed -i "s/:80>/:${PORT}>/g" /etc/apache2/sites-available/000-default.conf && \
    php artisan migrate --force && \
    apache2-foreground'