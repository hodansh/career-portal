FROM php:7.4-apache
RUN apt-get update \
    && apt-get upgrade -y
RUN docker-php-ext-install mysqli
# COPY ./src /var/www/html
RUN pecl install xdebug
ADD ./php.ini /user/local/etc/php/
EXPOSE 80