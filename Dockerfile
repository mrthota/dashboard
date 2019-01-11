FROM php:7.3.0-apache-stretch

RUN pecl install redis-4.0.1 \
    && docker-php-ext-enable redis 
    
RUN apt-get update && apt-get install -y vim && apt-get install -y iputils-ping \
    && apt-get install -y apt-utils

COPY ./index.php /var/www/html/

EXPOSE 80
