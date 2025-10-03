#!/bin/bash

# Iniciar Apache en segundo plano
apache2-foreground &
APACHE_PID=$!

# Esperar un poco para que Apache se inicie
sleep 5

# Verificar que Apache esté funcionando
if ps -p $APACHE_PID > /dev/null; then
    echo "Apache iniciado correctamente con PID: $APACHE_PID"
    
    # Hacer una prueba de healthcheck
    curl -f http://localhost/health.php || echo "Healthcheck falló"
    
    # Mantener Apache corriendo
    wait $APACHE_PID
else
    echo "Error: Apache no se pudo iniciar"
    exit 1
fi
