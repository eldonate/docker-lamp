FROM php:8.2-apache

# Install required build tools and PHP extension
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libzip-dev unzip git curl \
    && pecl install redis \
    && docker-php-ext-enable redis

# Optional: enable mod_rewrite for Laravel/Symfony-style routing
RUN a2enmod rewrite
