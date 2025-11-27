FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    npm

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Install dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Build frontend
RUN npm install && npm run build

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# THIS IS WRONG DURING BUILD → remove
# RUN php artisan cache:clear

# Symlink storage
RUN php artisan storage:link || true

# Railway sets PORT automatically
ENV PORT=8000

CMD sh -c "\
    php artisan config:clear && \
    php artisan cache:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan migrate --force || true && \
    php artisan serve --host=0.0.0.0 --port=${PORT} \
"
