FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install pdo_mysql zip mbstring \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Installer les dépendances avant de copier tout le projet
COPY composer.json composer.lock ./

# --no-scripts est important ici : artisan n'est pas encore copié
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction

# Copier maintenant le projet Laravel
COPY . .

# Générer l'autoload après avoir copié artisan et les fichiers Laravel
RUN composer dump-autoload --optimize --no-dev

RUN chmod -R 775 storage bootstrap/cache

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]



