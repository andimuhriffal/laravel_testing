# Gunakan image PHP FPM
FROM php:8.2-fpm

# Install dependencies sistem & PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring xml zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer dari official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files terlebih dahulu (untuk cache layer Docker)
COPY composer.json composer.lock ./

# Install dependensi (bisa ubah ke --no-dev sesuai kebutuhan lingkungan)
RUN composer install --optimize-autoloader

# Copy semua file project setelah composer install
COPY . .

# Pastikan direktori penting Laravel dibuat
RUN mkdir -p storage/logs \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expose port default PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
