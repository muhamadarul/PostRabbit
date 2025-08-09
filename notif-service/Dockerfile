FROM php:8.2-fpm

# Install dependencies (opsional, kalau belum)
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    zip \
    supervisor \
    && docker-php-ext-install pdo pdo_mysql sockets

# Install Composer (jika belum pakai multi-stage)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy source code
COPY . .

# Set file permissions (boleh tetap di sini)
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

COPY supervisord.conf /etc/supervisor/supervisord.conf

EXPOSE 9000

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]

