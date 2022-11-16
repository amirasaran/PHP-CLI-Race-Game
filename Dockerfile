FROM php:8.1.12-cli-alpine3.16

MAINTAINER Amir Mohsen Asaran <mihanmail.ir@gmail.com>

WORKDIR /app

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

ADD ["composer.json", "composer.lock", "/app/"]


RUN composer install --no-scripts

COPY [".", "/app/"]

RUN composer dumpautoload

# CMD ["php", "src/manager.php", "--number-of-vehicle", "4"]
