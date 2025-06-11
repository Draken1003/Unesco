FROM php:8.0-apache

# Installer les dépendances PostgreSQL pour PHP
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql

# Config Apache : ajouter index.php comme page d'index par défaut
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

# Supprimer le warning "ServerName"
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copier tout le contenu du dossier site/ vers /var/www/html/
COPY ./site/ /var/www/html/

# Changer les permissions pour que www-data puisse accéder aux fichiers
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80 pour le serveur web
EXPOSE 80
