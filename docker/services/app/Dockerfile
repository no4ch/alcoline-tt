FROM alpine:3.19.0

WORKDIR /app/

# install base system
RUN apk update && \
    apk upgrade

RUN apk --no-cache add curl

# install php and extensions
RUN apk add php83 \
	php83-phar \
	php83-iconv \
	php83-mbstring \
	php83-openssl \
    php83-sqlite3


# fix for getting php globaly
RUN ln -s /usr/bin/php83 /usr/bin/php

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.6.2
