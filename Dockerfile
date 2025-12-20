FROM php:8.3-fpm

# Cài các package hệ thống cần cho Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Thư mục làm việc
WORKDIR /var/www

# Copy toàn bộ source code
COPY . .

# Cài dependency PHP (không fail vì thiếu APP_KEY)
RUN composer install --no-interaction --prefer-dist

# Mở port cho Laravel serve
EXPOSE 8000
