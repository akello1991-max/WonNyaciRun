#!/usr/bin/env bash
set -e
php artisan storage:link || true
php artisan config:clear || true
if [ "${APP_ENV:-production}" = "production" ] && [ "${DB_CONNECTION:-mysql}" = "mysql" ] && [ -z "${MYSQLHOST:-}${MYSQL_PRIVATE_HOST:-}${DATABASE_URL:-}${MYSQL_URL:-}" ] && [ "${DB_HOST:-127.0.0.1}" = "127.0.0.1" ]; then
	echo "ERROR: No Railway MySQL connection variables are available. Link the MySQL service or set DB_HOST/DB_DATABASE/DB_USERNAME/DB_PASSWORD."
	exit 1
fi
php artisan migrate --force
php artisan db:seed --force
php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
