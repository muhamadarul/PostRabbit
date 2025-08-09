#!/bin/sh

# Composer install jika vendor belum ada
composer install --no-interaction --prefer-dist --optimize-autoloader


# # Jalankan migrate jika RUN_MIGRATION=true
# if [ "$RUN_MIGRATION" = "true" ]; then
#   php artisan migrate --force
# fi

# Jalankan command dari CMD
exec "$@"
