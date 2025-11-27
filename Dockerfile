FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    curl

# Install Node 18 LTS (WAJIB untuk Tailwind v4)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Install Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Install Tailwind + Vite build
RUN npm install --include=dev && npm run build

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Symlink storage
RUN php artisan storage:link || true

# Railway akan memberikan PORT otomatis
EXPOSE 8080

CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
