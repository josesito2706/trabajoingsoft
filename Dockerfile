FROM php:8.1-cli

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar servidor web simple
RUN apt-get update && apt-get install -y nginx && rm -rf /var/lib/apt/lists/*

# Copiar archivos de la aplicación
COPY . /var/www/html/

# Instalar dependencias de Composer
RUN cd /var/www/html && composer install --no-dev --optimize-autoloader

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Crear archivo de healthcheck simple
RUN echo '<?php http_response_code(200); echo "OK"; ?>' > /var/www/html/health.php

# Crear archivo de prueba
RUN echo '<?php echo "PHP funciona!"; ?>' > /var/www/html/test.php

# Configurar Nginx para usar $PORT de Railway
RUN echo 'server {\n\
    listen ${PORT:-80};\n\
    server_name localhost;\n\
    root /var/www/html;\n\
    index index.php index.html;\n\
    \n\
    location / {\n\
        try_files $uri $uri/ /index.php?$query_string;\n\
    }\n\
    \n\
    location ~ \.php$ {\n\
        fastcgi_pass 127.0.0.1:9000;\n\
        fastcgi_index index.php;\n\
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;\n\
        include fastcgi_params;\n\
    }\n\
}' > /etc/nginx/sites-available/default

# Configurar PHP-FPM para escuchar en 127.0.0.1:9000
RUN echo '[global]\n\
daemonize = no\n\
\n\
[www]\n\
listen = 127.0.0.1:9000\n\
pm = dynamic\n\
pm.max_children = 5\n\
pm.start_servers = 2\n\
pm.min_spare_servers = 1\n\
pm.max_spare_servers = 3' > /usr/local/etc/php-fpm.conf

# Copiar script de inicio mejorado
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Exponer puerto 80
EXPOSE 80

# Comando de inicio
CMD ["/start.sh"]
