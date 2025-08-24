#!/bin/sh
set -eu

LINK="/var/www/html/public/storage"
TARGET="/var/www/html/storage/app/public"

if [ -L "$LINK" ] && [ "$(readlink "$LINK")" = "$TARGET" ]; then
  echo "[init] storage symlink present: $LINK -> $TARGET"
  exit 0
fi

if [ -e "$LINK" ] && [ ! -L "$LINK" ]; then
  echo "[init] WARNING: $LINK exists and is not a symlink; leaving as-is."
  exit 0
fi

if touch /var/www/html/.rwcheck 2>/dev/null; then
  rm -f /var/www/html/.rwcheck
  mkdir -p "$TARGET"
  ln -sfn "$TARGET" "$LINK"
  echo "[init] created symlink $LINK -> $TARGET"
else
  echo "[init] read-only fs detected; ensure the symlink is baked into the image."
fi
