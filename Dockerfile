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
RUN echo '<VirtualHost *:80>' \
    && echo '    ServerAdmin webmaster@localhost' \
    && echo '    DocumentRoot /var/www/html/public' \
    && echo '    <Directory /var/www/html/public>' \
    && echo '        Options Indexes FollowSymLinks' \
    && echo '        AllowOverride All' \
    && echo '        Require all granted' \
    && echo '    </Directory>' \
    && echo '    ErrorLog ${APACHE_LOG_DIR}/error.log' \
    && echo '    CustomLog ${APACHE_LOG_DIR}/access.log combined' \
    && echo '</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

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
CMD php artisan migrate --force && apache2-foreground