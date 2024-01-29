# FROM php:8.1-apache

# # Install mysqli extension
# RUN docker-php-ext-install mysqli

# # Copy your application code
# COPY src/ /var/www/html/

# # Update Apache configuration to point to the correct directory
# RUN sed -i 's|/var/www/html/public|/var/www/html|g' /etc/apache2/sites-available/000-default.conf

# # Create the 'foto' directory if it doesn't exist
# RUN mkdir -p /var/www/html/public/foto

# # Set permissions to 777 for the 'foto' directory
# RUN chmod -R 777 /var/www/html/public/foto

# # Set permissions to 777 for the '/tmp' directory
# RUN chmod 777 /tmp

# # Add upload_tmp_dir setting to php.ini
# RUN echo "upload_tmp_dir = /tmp" >> /usr/local/etc/php/php.ini



# coba coba
FROM php:8.1-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Install Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Configure Xdebug
RUN echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Copy your application code
COPY src/ /var/www/html/

# Update Apache configuration to point to the correct directory
RUN sed -i 's|/var/www/html/public|/var/www/html|g' /etc/apache2/sites-available/000-default.conf

# Create the 'foto' directory if it doesn't exist
RUN mkdir -p /var/www/html/public/foto

# Set permissions to 777 for the 'foto' directory
RUN chmod -R 777 /var/www/html/public/foto

# Set permissions to 777 for the '/tmp' directory
RUN chmod 777 /tmp

# Add upload_tmp_dir setting to php.ini
RUN echo "upload_tmp_dir = /tmp" >> /usr/local/etc/php/php.ini
