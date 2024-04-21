FROM php:8.3.6-apache

# Copy the PHP application code
COPY ./src/ /var/www/html/

# Enable Apache rewrite module
RUN a2enmod rewrite

WORKDIR /var/www/html/

EXPOSE 80