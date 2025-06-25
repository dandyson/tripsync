#!/bin/bash
set -e

echo "Starting Railway build process..."

# Install PHP dependencies
echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

# Install Node.js dependencies
echo "Installing Node.js dependencies..."
npm install

# Build assets
echo "Building assets..."
npm run build

# Generate application key if not exists
if [ -z "$APP_KEY" ]; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Clear and cache config
echo "Caching configuration..."
php artisan config:clear
php artisan config:cache

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Set permissions
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache

echo "Build completed successfully!"
