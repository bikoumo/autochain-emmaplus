FROM php:8.2-apache

# Installer les extensions et dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    libonig-dev \
    libxml2-dev \
    sqlite3 \
    libsqlite3-dev \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd

# Activer mod_rewrite pour Apache
RUN a2enmod rewrite

# Configurer proprement le VirtualHost d'Apache pour pointer vers le dossier public de Laravel
RUN echo '<VirtualHost *:80>' > /etc/apache2/sites-available/000-default.conf \
    && echo '    ServerAdmin webmaster@localhost' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    DocumentRoot /var/www/html/public' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    <Directory /var/www/html/public>' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        Options Indexes FollowSymLinks' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        AllowOverride All' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        Require all granted' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    </Directory>' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    ErrorLog ${APACHE_LOG_DIR}/error.log' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    CustomLog ${APACHE_LOG_DIR}/access.log combined' >> /etc/apache2/sites-available/000-default.conf \
    && echo '</VirtualHost>' >> /etc/apache2/sites-available/000-default.conf

# Copier les fichiers du projet
COPY . /var/www/html

WORKDIR /var/www/html

# Installer les dépendances PHP via Composer
RUN composer install --no-dev --optimize-autoloader

# Permissions pour Laravel (storage et bootstrap/cache)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Créer le fichier de base de données SQLite et ajuster ses permissions
RUN mkdir -p /var/www/html/database \
    && touch /var/www/html/database/database.sqlite \
    && chown -R www-data:www-data /var/www/html/database \
    && chmod -R 775 /var/www/html/database

EXPOSE 80

# Script de démarrage : lance les migrations SQLite puis démarre Apache
# Exemple de commande finale (CMD) dans ton Dockerfile
CMD php artisan config:clear && php artisan migrate:fresh --seed --force && php artisan serve --host=0.0.0.0 --port=10000CMD php artisan config:clear && php artisan migrate:fresh --seed --force && php artisan serve --host=0.0.0.0 --port=10000