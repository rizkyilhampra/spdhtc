#!/usr/bin/env sh
set -eu

log() { printf '%s\n' "[entrypoint] $*"; }
warn() { printf '%s\n' "[entrypoint][warn] $*" >&2; }

APP_ENV_DEFAULT="${APP_ENV:-production}"
CACHE_ON_START="${CACHE_ON_START:-1}"
MIGRATE_ON_START="${MIGRATE_ON_START:-}"

if [ -d /var/www/html/storage ]; then
  mkdir -p /var/www/html/storage/{app,framework/{cache,sessions,views},logs} || true
  chown -R 82:82 /var/www/html/storage || true
fi

if [ ! -d /var/www/html/bootstrap/cache ]; then
  mkdir -p /var/www/html/bootstrap/cache || true
fi
chmod 1777 /var/www/html/bootstrap/cache || true

if [ -f /var/www/html/artisan ]; then
  if [ "$CACHE_ON_START" = "1" ] && [ "$APP_ENV_DEFAULT" = "production" ]; then
    log "warming Laravel caches..."
    php /var/www/html/artisan optimize:clear --no-ansi || true
    php /var/www/html/artisan optimize --no-ansi
    php /var/www/html/artisan cache:provinces --no-ansi
    php /var/www/html/artisan cache:cities --no-ansi
    log "caches ready."
  else
    log "skipping cache warm (CACHE_ON_START=$CACHE_ON_START, APP_ENV=$APP_ENV_DEFAULT)"
  fi

  if [ "${MIGRATE_ON_START}" = "1" ]; then
    log "running database migrations (--force)"
    php /var/www/html/artisan migrate --force --no-ansi || {
      warn "migrations failed"; exit 1;
    }
  fi
else
  warn "artisan not found; skipping Laravel tasks."
fi

exec "$@"
