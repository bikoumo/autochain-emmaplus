#!/bin/sh
set -e

echo "=== Attente de la disponibilité de la base de données ==="
until php artisan db:show > /dev/null 2>&1; do
  echo "Base pas encore prête, nouvelle tentative dans 2s..."
  sleep 2
done

echo "=== Exécution des migrations ==="
php artisan migrate --force

echo "=== Cache Laravel ==="
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec "$@"