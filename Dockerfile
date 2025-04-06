# Use PHP with Apache
FROM php:8.2-apache

# Install MySQLi extension
RUN docker-php-ext-install mysqli

# Copy source code to Apache directory
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

