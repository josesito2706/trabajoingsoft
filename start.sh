#!/bin/bash
set -e

# Iniciar php-fpm en background
php-fpm &

# Iniciar nginx en foreground (para que el contenedor se mantenga vivo)
nginx -g "daemon off;"