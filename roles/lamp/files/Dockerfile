FROM php:8.2-apache

# Install dependencies, PHP MySQL extensions and Redis
RUN apt-get update \
 && apt-get install -y \
       libpng-dev \
       libonig-dev \
       libzip-dev \
       unzip \
       git \
       curl \
       default-libmysqlclient-dev \
 && docker-php-ext-install mysqli pdo pdo_mysql \
 && pecl install redis \
 && docker-php-ext-enable redis \
 && a2enmod rewrite \
 && rm -rf /var/lib/apt/lists/*

# Expose Apache
EXPOSE 80
