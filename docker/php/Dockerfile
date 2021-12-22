FROM php:8.0-fpm-alpine

RUN apk update && apk add unzip
RUN apk add --no-cache git

RUN apk add --no-cache autoconf g++ make \
    && pecl install xdebug \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install sockets

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini
COPY conf.d /usr/local/etc/php/conf.d

ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet

RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk add --no-cache shadow bash bash-doc bash-completion

ARG UID=1000
ARG GUID=1000
RUN usermod -u $UID www-data && groupmod -g $GUID www-data


RUN  pecl install xdebug \
    && docker-php-ext-enable xdebug

# Redis
RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

# amqp
RUN apk add rabbitmq-c rabbitmq-c-dev
RUN pecl install amqp \
&&  rm -rf /tmp/pear \
&& docker-php-ext-enable amqp

# apcu
RUN pecl install apcu \
&&  rm -rf /tmp/pear \
&& docker-php-ext-enable apcu

# kafka
RUN apk add librdkafka librdkafka-dev \
    && pecl install rdkafka \
    && docker-php-ext-enable rdkafka

## NPM
RUN apk add --update nodejs npm

## PM2
RUN apk add -u nghttp2
RUN npm install pm2 -g && pm2 update
#RUN usermod -aG pm2 www-data
RUN mkdir /.pm2 && chown www-data:www-data /.pm2

WORKDIR /app