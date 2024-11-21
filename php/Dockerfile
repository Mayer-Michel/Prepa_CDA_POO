FROM php:8.3-fpm-alpine
 
# installation des extensions supplémentaire
RUN apk add --no-cache icu-dev \
&& docker-php-ext-install pdo pdo_mysql \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl \
&& docker-php-ext-enable intl
 
ARG UNAME=www-data
ARG UGROUP=www-data
#ARG UID=1001 pour linux
#ARG GID=1001 pour linux
ARG UID=501
ARG GID=204
 
RUN deluser www-data
#RUN addgroup -g 1001 www-data //pour linux
#RUN adduser -u 1001 -D -S -G www-data www-data // pour linux
RUN addgroup -g 204 www-data
RUN adduser -u 501 -D -S -G www-data www-data
 
# installation de composer dans le container
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
 
# déclaration du repertoire de travail
WORKDIR /var/www/html