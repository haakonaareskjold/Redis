FROM php:7.4-alpine

RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
        && pecl install redis \
        && docker-php-ext-enable redis.so

CMD /etc/init.d/redis-server start