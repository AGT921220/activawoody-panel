# Usa la imagen base de PHP 7.2 con FPM
FROM php:7.2-fpm

# Evita prompts durante la instalación de paquetes
ENV DEBIAN_FRONTEND=noninteractive

# ---------------------------------------------------
# 1. Instalar dependencias y extensiones de PHP
# ---------------------------------------------------
RUN apt-get update && apt-get install -y --no-install-recommends \
    pkg-config \
    default-mysql-client \
    supervisor \
    libzip-dev \
    zip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    curl \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/freetype2 --with-jpeg-dir=/usr/include \
    && docker-php-ext-install -j$(nproc) \
       mysqli \
       pdo_mysql \
       zip \
       gd \
       mbstring \
       exif \
       pcntl \
       bcmath \
       soap \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ---------------------------------------------------
# 2. Instalar y habilitar Xdebug (versión compatible para PHP 7.2)
# ---------------------------------------------------
RUN pecl install xdebug-2.9.8 \
    && docker-php-ext-enable xdebug

# ---------------------------------------------------
# 3. Instalar IonCube Loader para PHP 7.2
# ---------------------------------------------------
RUN EXT_DIR=$(php -i | awk '/^extension_dir/ {print $3}') && \
    mkdir /tmp/ioncube && cd /tmp/ioncube && \
    curl -fsSL https://downloads.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz -o ioncube_loaders.tar.gz && \
    tar -xzf ioncube_loaders.tar.gz && \
    mv ioncube/ioncube_loader_lin_7.2.so $EXT_DIR/ioncube_loader_lin_7.2.so && \
    echo "zend_extension=$EXT_DIR/ioncube_loader_lin_7.2.so" > /usr/local/etc/php/conf.d/00-ioncube.ini && \
    cd ~ && rm -rf /tmp/ioncube

# ---------------------------------------------------
# 4. Directorio de trabajo
# ---------------------------------------------------
WORKDIR /var/www/html
