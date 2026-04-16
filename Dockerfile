# Builder Stage - untuk install dependencies
FROM php:8.1-fpm AS builder

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    wget \
    curl \
    git \
    npm

# Clear apt cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

    # Create required directories with proper permissions
    RUN mkdir -p bootstrap/cache storage && \
        chmod -R 755 bootstrap/cache storage

# Install Node.js dependencies for Vite
RUN npm install

# Build frontend assets with Vite
RUN npm run build

# Production Stage
FROM php:8.1-fpm

WORKDIR /var/www/html

# Install runtime system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    locales \
    jpegoptim optipng pngquant gifsicle \
    curl

# Clear apt cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set locale
RUN sed -i -e 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen && \
    locale-gen
ENV LANG=en_US.UTF-8
ENV LANGUAGE=en_US:en
ENV LC_ALL=en_US.UTF-8

# Copy application files from builder
COPY --from=builder /var/www/html /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Create symlink for storage
RUN php artisan storage:link || true

# Expose port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
