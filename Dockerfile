FROM debian
#FROM php:7.0-fpm
MAINTAINER Sarah Carolina J. Silva

RUN apt-get update
RUN apt-get install vim nginx libpcre3 -y
RUN apt-get install php7.0-fpm -y

RUN rm /etc/nginx/sites-enabled/default
COPY default /etc/nginx/sites-available/
RUN ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

RUN apt-get install libsqlite3-dev sqlite3 -y

RUN mkdir /db

#RUN docker-php-ext-install pdo pdo_sqlite

COPY php.ini /etc/php/7.0/fpm/

CMD service nginx start && service php7.0-fpm start && /bin/bash