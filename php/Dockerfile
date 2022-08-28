FROM php:8.1-fpm
ENV DEBIAN_FRONTEND noninteractive

RUN pecl install redis && pecl install apcu

COPY ./www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./php-fpm.conf /usr/local/etc/php-fpm.conf
COPY ./php.ini /usr/local/etc/php/php.ini
