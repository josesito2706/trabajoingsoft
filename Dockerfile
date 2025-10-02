FROM heroku/heroku:20-build

# Instalar PHP y extensiones necesarias
RUN apt-get update && apt-get install -y \
    php8.1 \
    php8.1-cli \
    php8.1-mysql \
    php8.1-mysqli \
    php8.1-xml \
    php8.1-mbstring \
    php8.1-curl \
    apache2 \
    libapache2-mod-php8.1 \
    composer \
    && rm -rf /var/lib/apt/lists/*

# Configurar Apache
RUN a2enmod php8.1
RUN a2enmod rewrite

# Copiar archivos de la aplicación
COPY . /var/www/html/

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Instalar dependencias de Composer
RUN cd /var/www/html && composer install --no-dev --optimize-autoloader

# Configurar Apache para servir desde /var/www/html
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
CMD ["apache2ctl", "-D", "FOREGROUND"]
