FROM php:8.4-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libzip-dev libpng-dev libonig-dev libicu-dev libxml2-dev \
    libfreetype6-dev libjpeg62-turbo-dev curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql zip intl gd opcache bcmath \
    && a2dismod mpm_event mpm_worker mpm_prefork || true \
    && a2enmod mpm_prefork rewrite \
    && apache2ctl configtest \
    && apache2ctl -M | grep mpm \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update \
    && apt-get install -y --no-install-recommends nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri \
    -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    && sed -ri \
    -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

RUN printf '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n' \
    > /etc/apache2/conf-available/z-laravel.conf \
    && a2enconf z-laravel

COPY composer.json composer.lock ./
COPY package.json package-lock.json* ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --no-scripts \
    --no-autoloader

RUN npm ci

COPY . .

RUN composer dump-autoload --optimize --no-dev

RUN npm run build

RUN mkdir -p \
        storage/framework/sessions \
        storage/framework/cache \
        storage/framework/views \
        bootstrap/cache \
    && chown -R www-data:www-data \
        storage \
        bootstrap/cache \
        public/build \
    && chmod -R 775 storage bootstrap/cache \
    && test -f public/build/manifest.json \
    && test -f vendor/autoload.php

ENV PORT=8080

EXPOSE 8080

CMD ["sh", "-c", "\
    sed -i \"s/^Listen .*/Listen ${PORT}/\" /etc/apache2/ports.conf && \
    sed -i \"s/<VirtualHost \\*:80>/<VirtualHost *:${PORT}>/\" /etc/apache2/sites-available/000-default.conf && \
    apache2ctl configtest && \
    php artisan migrate --force && \
    exec apache2-foreground \
"]