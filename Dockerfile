FROM php:8.1-apache

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Habilitar mod_rewrite
RUN a2enmod rewrite

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

# Configurar Apache para escuchar en el puerto correcto
RUN echo 'Listen 80' > /etc/apache2/ports.conf
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf

# Configurar VirtualHost
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Exponer puerto 80
EXPOSE 80

# Comando de inicio simple
CMD ["apache2-foreground"]
