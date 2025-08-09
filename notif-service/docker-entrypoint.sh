#!/bin/sh

# Composer install jika vendor belum ada
if [ ! -f "vendor/autoload.php" ]; then
  composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# Jalankan migrate jika RUN_MIGRATION=true
if [ "$RUN_MIGRATION" = "true" ]; then
  php artisan migrate --force
fi

# Jalankan command dari CMD
exec "$@"
