FROM php:8.3.6-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo_mysql

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy the PHP application code
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/

# Make entrypoint script executable
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Install things in compose.json
RUN composer install

# Expose port 80
EXPOSE 80

# Set entrypoint
ENTRYPOINT ["docker-entrypoint.sh"]
