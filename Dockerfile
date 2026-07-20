FROM php:8.3-fpm-alpine

# Set working directory
WORKDIR /app

# Install system dependencies
RUN apk add --no-cache \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    unzip \
    git \
    postgresql-dev \
    redis \
    bash

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    gd \
    pdo \
    pdo_pgsql \
    redis \
    bcmath \
    ctype \
    json \
    mbstring \
    tokenizer \
    xml

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files
COPY composer.json composer.lock* ./

# Install PHP dependencies
RUN composer install --no-dev --no-interaction --no-progress

# Copy application
COPY . .

# Set permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Expose port
EXPOSE 9000

CMD ["php-fpm"]
