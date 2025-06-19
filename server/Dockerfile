FROM laravelsail/php82-composer

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

COPY . .

RUN composer install

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
