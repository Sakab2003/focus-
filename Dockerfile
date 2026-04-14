FROM php:8.2-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

EXPOSE 10000

CMD touch database/database.sqlite && php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 10000