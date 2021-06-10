FROM php:7.2

RUN apt-get update -y && apt-get install -y openssl zip unzip git
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin -- filename=composer
# Install composer:
#RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/1b137f8bf6db3e79a38a5bc45324414a6b1f9df2/web/installer -O - -q | php -- --quiet
#RUN mv /var/www/html/composer.phar /usr/local/bin/composer
#RUN mv composer.phar /usr/local/bin/composer

# Install composer
RUN rm -rf /var/www/html
RUN curl -sS https://getcomposer.org/installer | php
RUN mv /composer.phar /usr/local/bin/composer

RUN docker-php-ext-install pdo mbstring pdo_mysql

WORKDIR /app
COPY . .
RUN composer install

CMD php artisan serve --host=0.0.0.0
EXPOSE 8000 8081
