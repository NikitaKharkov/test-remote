FROM php:8.2-apache

RUN apt-get update && apt-get install vim -y
RUN docker-php-ext-install mysqli

EXPOSE 3000