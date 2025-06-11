FROM php:8.0-apache

RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Forcer Apache à utiliser index.php comme index
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

COPY ./site/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
