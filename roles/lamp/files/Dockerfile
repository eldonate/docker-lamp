FROM php:8.2-apache

# 1) Install system deps, PHP extensions (mysqli, PDO, OPcache) and Redis
RUN apt-get update \
 && apt-get install -y \
       libpng-dev \
       libonig-dev \
       libzip-dev \
       unzip \
       git \
       curl \
       default-libmysqlclient-dev \
 && docker-php-ext-install mysqli pdo pdo_mysql opcache \
 && pecl install redis \
 && docker-php-ext-enable redis opcache \
 && a2enmod rewrite \
 && rm -rf /var/lib/apt/lists/*

# 2) Tune PHP settings and OPcache
RUN { \
     echo "memory_limit = 512M"; \
     echo "upload_max_filesize = 50M"; \
     echo "post_max_size = 50M"; \
     echo "max_execution_time = 120"; \
     echo "max_input_vars = 8000"; \
     echo ""; \
     echo "; OPcache settings"; \
     echo "opcache.memory_consumption = 128"; \
     echo "opcache.interned_strings_buffer = 8"; \
     echo "opcache.max_accelerated_files = 10000"; \
     echo "opcache.revalidate_freq = 0"; \
     echo "opcache.validate_timestamps = 1"; \
   } > /usr/local/etc/php/conf.d/zz-custom.ini

# 3) Expose Apache’s port
EXPOSE 80
