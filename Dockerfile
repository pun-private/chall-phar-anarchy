FROM php:7.3.2-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get install -y netcat

COPY src/ /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 0555 /var/www/html
RUN chmod -R 0777 /var/www/html/app/chaos /var/www/html/app/tmp
RUN chmod -R 0555 /var/www/html/app/chaos/.htaccess

EXPOSE 80
