FROM php:7.4

RUN  apt-get update \
     && apt-get install redis -y

CMD /etc/init.d/redis-server start