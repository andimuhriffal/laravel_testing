# Gunakan base image PHP lengkap
FROM php:8.2-fpm

# Install dependencies dan PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring xml zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Salin Composer dari official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy semua source Laravel
COPY . .

# Buat folder penting (jika belum ada) dan atur permission
RUN mkdir -p /var/www/storage/logs /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Install dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Expose port default PHP-FPM
EXPOSE 9000

# Jalankan PHP-FPM
CMD ["php-fpm"]
