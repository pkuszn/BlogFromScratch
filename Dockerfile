# Use the official PHP image with Apache
FROM php:7.4-apache

WORKDIR /var/www/html

COPY . .

RUN apt-get update && \
    apt-get install -y libpng-dev && \
    docker-php-ext-install pdo pdo_mysql gd && \
    docker-php-ext-install mysqli && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

RUN echo "DocumentRoot /var/www/html/public" >> /etc/apache2/sites-available/000-default.conf && \
    echo "<Directory /var/www/html/public>" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    Options Indexes FollowSymLinks" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    AllowOverride All" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    Require all granted" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    LogLevel crit" >> /etc/apache2/sites-available/000-default.conf && \
    echo "</Directory>" >> /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]
