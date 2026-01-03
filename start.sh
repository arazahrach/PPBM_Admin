#!/usr/bin/env bash
set -e

# Laravel basic runtime checks
php -v

# Ensure APP_KEY exists
if [ -z "$APP_KEY" ]; then
  echo "ERROR: APP_KEY is not set"
  exit 1
fi

# Cache config/routes/views (optional but recommended)
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Start php-fpm in background
php-fpm -D

# Start nginx
nginx -g "daemon off;"
