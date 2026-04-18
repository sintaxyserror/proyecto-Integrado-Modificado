FROM php:8.1-apache
ARG DEBIAN_FRONTEND=noninteractive

# install PDO PostgreSQL drivers
RUN docker-php-ext-install pdo pdo_pgsql

# Keep MySQL support for backward compatibility (removed xdebug for production)
RUN apt-get update \
    && apt-get install -y sendmail libpng-dev \
    && apt-get install -y libzip-dev \
    && apt-get install -y zlib1g-dev \
    && apt-get install -y libonig-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install zip

RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip
RUN docker-php-ext-install gd

RUN a2enmod rewrite

# Copiar archivos de la aplicación
COPY codigo/inflaestructura/www /var/www/html/
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html


