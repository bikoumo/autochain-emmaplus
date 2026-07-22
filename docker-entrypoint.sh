#!/bin/sh
set -e

echo "=== Attente de la disponibilité de la base de données PostgreSQL ==="

# On extrait les infos de DATABASE_URL ou on utilise les variables par défaut
until php -r "
$url = getenv('DATABASE_URL');
if (!$url) {
    exit(1);
}
$parsed = parse_url($url);
$host = $parsed['host'] ?? 'localhost';
$port = $parsed['port'] ?? '5432';
$dbname = ltrim($parsed['path'] ?? '', '/');
$user = $parsed['user'] ?? '';
$pass = $parsed['pass'] ?? '';

try {
    $pdo = new PDO(\"pgsql:host=\$host;port=\$port;dbname=\$dbname\", \$user, \$pass);
    exit(0);
} catch (\PDOException \$e) {
    exit(1);
}
"; do
  echo "Base pas encore prête, nouvelle tentative dans 2s..."
  sleep 2
done

echo "=== Base de données disponible ! ==="

echo "=== Exécution des migrations ==="
php artisan migrate --force

echo "=== Cache Laravel ==="
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec "$@"