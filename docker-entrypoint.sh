#!/bin/sh

# Copy .env if missing
cp .env.example .env

# Generate app key
php artisan key:generate --ansi

# Link storage
php artisan storage:link --ansi

# wait-for-it db to start
sleep 15

# Run migrations & seed
php artisan migrate --seed --ansi

# Start Laravel dev server
php artisan serve --host=0.0.0.0 --port=8001

