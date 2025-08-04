FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev \
    libpng-dev libonig-dev libxml2-dev \
    libpq-dev libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_mysql sockets

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy source
COPY . .

# Install Laravel dependencies
RUN composer install

# Set permission
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

EXPOSE 9000

CMD ["php-fpm"]
