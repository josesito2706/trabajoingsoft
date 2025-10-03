#!/bin/bash

# Función para manejar la terminación
cleanup() {
    echo "Deteniendo servicios..."
    kill $NGINX_PID 2>/dev/null
    kill $PHPFPM_PID 2>/dev/null
    exit 0
}

# Configurar trap para cleanup
trap cleanup SIGTERM SIGINT

# Iniciar PHP-FPM
echo "Iniciando PHP-FPM..."
php-fpm --nodaemonize &
PHPFPM_PID=$!

# Esperar a que PHP-FPM se inicie
sleep 3

# Verificar que PHP-FPM esté funcionando
if ! kill -0 $PHPFPM_PID 2>/dev/null; then
    echo "Error: PHP-FPM no se pudo iniciar"
    exit 1
fi

echo "PHP-FPM iniciado con PID: $PHPFPM_PID"

# Iniciar Nginx
echo "Iniciando Nginx..."
nginx -g "daemon off;" &
NGINX_PID=$!

# Esperar a que Nginx se inicie
sleep 2

# Verificar que Nginx esté funcionando
if ! kill -0 $NGINX_PID 2>/dev/null; then
    echo "Error: Nginx no se pudo iniciar"
    kill $PHPFPM_PID 2>/dev/null
    exit 1
fi

echo "Nginx iniciado con PID: $NGINX_PID"
echo "Servicios iniciados correctamente"

# Mantener el script corriendo
wait $NGINX_PID