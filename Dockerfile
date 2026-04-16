FROM php:8.1-fpm

# Install system dependencies (Alat yang dibutuhkan Composer & Laravel)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (PENTING: pdo_mysql & zip sering bikin error kalau tidak ada)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install dependencies (Tanpa scripts dulu untuk menghindari error permission/env)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Set permissions untuk storage Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]