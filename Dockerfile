# Gunakan base image PHP lengkap
FROM php:8.2-fpm

# Install dependencies dan PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring xml zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer dari official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project Laravel
COPY . .

# Install Laravel dependencies (non-dev, optimize autoloader)
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# Expose port PHP-FPM
EXPOSE 9000

# Jalankan php-fpm
CMD ["php-fpm"]


