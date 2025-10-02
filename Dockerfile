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

# Configurar Apache
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Exponer puerto 80
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]
