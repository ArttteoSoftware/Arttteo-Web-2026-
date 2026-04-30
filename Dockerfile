FROM php:8.3-apache-bookworm

WORKDIR /var/www/html

# Install system deps
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libzip-dev zlib1g-dev libpng-dev libjpeg-dev \
    libfreetype6-dev libonig-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j$(nproc) pdo_mysql mbstring intl zip bcmath exif gd opcache \
 && a2enmod rewrite headers expires \
 && sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
 && sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# PHP Config
RUN { \
  echo 'memory_limit=512M'; \
  echo 'upload_max_filesize=25M'; \
  echo 'post_max_size=25M'; \
  echo 'max_execution_time=120'; \
  echo 'opcache.enable=1'; \
  echo 'opcache.enable_cli=1'; \
  echo 'opcache.jit=1255'; \
  echo 'opcache.jit_buffer_size=128M'; \
  echo 'opcache.memory_consumption=256'; \
  echo 'opcache.max_accelerated_files=20000'; \
  echo 'opcache.validate_timestamps=0'; \
} > /usr/local/etc/php/conf.d/custom.ini

# Copy project files
COPY . .

# Fix Git ownership issue
RUN git config --global --add safe.directory /var/www/html

# Fix permissions (inside image, BEFORE volume overrides)
RUN mkdir -p storage bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache
EXPOSE 80
