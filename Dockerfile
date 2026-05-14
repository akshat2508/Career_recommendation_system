FROM php:8.2-cli

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chmod -R 777 storage bootstrap/cache

# Build frontend assets



# Storage link
RUN php artisan storage:link || true

# Expose Render port
EXPOSE 10000

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=$PORT