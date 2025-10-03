FROM php:8.1-apache

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Copiar configuración de Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copiar archivos de la aplicación
COPY . /var/www/html/

# Instalar dependencias de Composer
RUN cd /var/www/html && composer install --no-dev --optimize-autoloader

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Crear archivo de prueba simple
RUN echo '<?php echo "PHP funciona correctamente!"; ?>' > /var/www/html/simple.php

# Crear archivo de healthcheck
RUN echo '<?php http_response_code(200); echo "OK"; ?>' > /var/www/html/health.php

# Copiar script de inicio
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Instalar curl para healthcheck
RUN apt-get update && apt-get install -y curl && rm -rf /var/lib/apt/lists/*

# Configurar Apache de forma más simple
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf

# Exponer puerto 80
EXPOSE 80

# Comando de inicio
CMD ["/start.sh"]
