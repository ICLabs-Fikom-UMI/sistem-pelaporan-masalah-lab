FROM php:8.1-apache
# Install msyqli extension
RUN docker-php-ext-install mysqli
COPY src/ /var/www/html/
RUN sed -i 's|/var/www/html/public|/var/www/html|g' /etc/apache2/sites-available/000-default.conf
