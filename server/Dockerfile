FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy the entire application
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node.js dependencies and build assets
RUN npm install
RUN npm run build

# Verify assets were built
RUN ls -la public/build/

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port (Railway will override this)
EXPOSE 8080

# Run build script to migrate database
RUN chmod +x build.sh
RUN ./build.sh

# Start the application using Railway's PORT
CMD php artisan serve --host=0.0.0.0 --port=$PORT
