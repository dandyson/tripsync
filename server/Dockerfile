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

# Copy composer files first for better caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copy package files
COPY package.json package-lock.json ./
RUN npm install

# Copy the rest of the application
COPY . .

# Build assets
RUN npm run build

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port (Railway will override this)
EXPOSE 8080

# Start the application using Railway's PORT
CMD php artisan serve --host=0.0.0.0 --port=$PORT
