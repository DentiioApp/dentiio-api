FROM php:7.4-fpm

RUN apt-get update && \
    apt-get install -y nano vim tree git libzip-dev zip gnupg && \
    docker-php-ext-configure zip && \
    docker-php-ext-install zip && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install mysqli && \
    docker-php-ext-install bcmath && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug 
    
RUN apt-get install -y libpng-dev libfreetype6-dev libjpeg62-turbo-dev && \
    docker-php-ext-configure gd && \
    docker-php-ext-install -j$(nproc) gd && \
    docker-php-ext-install exif

RUN curl --silent --show-error https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer