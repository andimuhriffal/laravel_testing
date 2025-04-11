FROM php:8.2-fpm

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring tokenizer xml zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set workdir dan copy source
WORKDIR /var/www

COPY . .

# Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Set permission
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

EXPOSE 9000
CMD ["php-fpm"]
