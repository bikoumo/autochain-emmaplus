#!/bin/sh
set -e

echo "=== Résolution de DATABASE_URL pour Laravel ==="

# Si DATABASE_URL est défini mais pas les DB_* individuelles, on synchronise
if [ -n "$DATABASE_URL" ] && [ -z "$DB_HOST" ]; then
    echo "Extraction de DATABASE_URL vers DB_HOST/DB_PORT/DB_DATABASE/DB_USERNAME/DB_PASSWORD..."
    
    # Extraction via PHP (fiable, déjà dispo dans l'image)
    eval $(php -r "
        \$url = getenv('DATABASE_URL');
        \$parsed = parse_url(\$url);
        echo 'DB_HOST=' . (\$parsed['host'] ?? 'localhost') . PHP_EOL;
        echo 'DB_PORT=' . (\$parsed['port'] ?? '5432') . PHP_EOL;
        echo 'DB_DATABASE=' . ltrim(\$parsed['path'] ?? '', '/') . PHP_EOL;
        echo 'DB_USERNAME=' . (\$parsed['user'] ?? '') . PHP_EOL;
        echo 'DB_PASSWORD=' . (\$parsed['pass'] ?? '') . PHP_EOL;
        echo 'DB_CONNECTION=pgsql' . PHP_EOL;
        echo 'DB_URL=' . \$url . PHP_EOL;
    ")
fi

echo "=== Attente de PostgreSQL ==="

until php -r "
    \$url = getenv('DATABASE_URL');
    if (!\$url) { exit(1); }
    \$parsed = parse_url(\$url);
    \$host = \$parsed['host'] ?? 'localhost';
    \$port = \$parsed['port'] ?? '5432';
    \$dbname = ltrim(\$parsed['path'] ?? '', '/');
    \$user = \$parsed['user'] ?? '';
    \$pass = \$parsed['pass'] ?? '';
    try {
        new PDO(\"pgsql:host=\$host;port=\$port;dbname=\$dbname\", \$user, \$pass);
        exit(0);
    } catch (\PDOException \$e) { exit(1); }
"; do
  echo "PostgreSQL pas encore prêt, nouvelle tentative dans 2s..."
  sleep 2
done

echo "=== PostgreSQL disponible ! ==="

echo "=== Vérification de la clé APP_KEY ==="
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "None" ] || [ "$APP_KEY" = "null" ]; then
    echo "APP_KEY manquante, génération automatique..."
    php artisan key:generate --force
fi

echo "=== Configuration du cache Laravel ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Exécution des migrations ==="
php artisan migrate --force

exec "$@"

