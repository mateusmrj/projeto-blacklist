FROM sarahcjs/php-nginx

MAINTAINER Sarah Carolina J. Silva

RUN apt-get update
RUN apt-get install sqlite3 -y
RUN mkdir /db


CMD service nginx start && service php7.0-fpm start && /bin/bash
