FROM php:8.1-apache
ARG DEBIAN_FRONTEND=noninteractive

# Instalar dependencias necesarias primero
RUN apt-get update && apt-get install -y \
    libpq-dev \
    sendmail \
    libpng-dev \
    libzip-dev \
    zlib1g-dev \
    libonig-dev \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-install pdo pdo_pgsql
RUN docker-php-ext-install mbstring zip gd

# Habilitar módulo rewrite
RUN a2enmod rewrite

# Copiar archivos de la aplicación
COPY codigo/inflaestructura/www /var/www/html/
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html



