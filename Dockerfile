FROM php:8.3-apache

# Installe les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-install pdo pdo_mysql gd

# Configure Apache
COPY . /var/www/html
WORKDIR /var/www/html

# Installe Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installe les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Configure les permissions de stockage et cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose le port 8080
EXPOSE 8080

# Commande de démarrage
CMD php artisan serve --host=0.0.0.0 --port=8080
