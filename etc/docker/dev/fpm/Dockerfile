ARG COMPOSER_VERSION="2.1.5"

FROM composer:${COMPOSER_VERSION} AS composer

FROM php:7.4.1-fpm-alpine3.10

# Install developer tools
ADD etc/docker/dev/fpm/files /
ARG HOST_IP
RUN true \
 && apk add --no-cache \
        git \
        php7-pecl-xdebug \
        vim \
 && sed -i "/^xdebug.remote_host/s/localhost/${HOST_IP}/g" /etc/php7/conf.d/00_xdebug.ini \
;

RUN docker-php-ext-install pdo pdo_mysql

# Add custom user
ARG USER_ID
ARG GROUP_ID
RUN true \
 && addgroup -g $GROUP_ID user \
 && adduser -DS -u $USER_ID -h /home/user -G user user \
;

USER user

# Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN true \
 && composer global require --quiet \
 && composer clear-cache --quiet \
;
