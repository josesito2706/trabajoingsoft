FROM php:8.1-cli

# Instalar extensiones PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalar nginx
RUN apt-get update && apt-get install -y nginx && rm -rf /var/lib/apt/lists/*

# Copiar composer desde imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar proyecto
COPY . /var/www/html/
WORKDIR /var/www/html

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Permisos correctos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Healthcheck & test page
RUN echo '<?php http_response_code(200); echo "OK"; ?>' > /var/www/html/health.php
RUN echo '<?php echo "PHP funciona!"; ?>' > /var/www/html/test.php

# Configuración nginx
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

# Configuración php-fpm
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

# Copiar script de arranque
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Puerto expuesto
EXPOSE 80

# Ejecutar script como comando principal
CMD ["/start.sh"]
