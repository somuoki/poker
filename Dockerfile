FROM php:8.0-cli-alpine
COPY . /usr/src/poker
WORKDIR /usr/src/poker
#RUN apk add --no-cache bash
RUN [ "php", "poker" ]
CMD php poker play





#FROM composer:2.1.8 as vendor
#
#WORKDIR /tmp/
#
#COPY composer.json composer.json
#COPY composer.lock composer.lock
#
#RUN composer install \
#    --ignore-platform-reqs \
#    --no-interaction \
#    --no-plugins \
#    --no-scripts \
#    --prefer-dist
#
#
#
## Define the base image on which your image is
#FROM php:8.0.10-cli-alpine
#
## Optionally install additionnal packages / extensions or customize
## RUN docker-php-ext-install pdo_mysql
#
## Include and commit your project files
#ADD ./ /poker
#
## Define the full path of the base command that will be executed
#ENTRYPOINT ["/poker"]


#FROM php:7.2-apache-stretch
#
#COPY . /var/www/html
#COPY --from=vendor /tmp/vendor/ /var/www/html/vendor/
#
## Define the base image on which your image is
#FROM php:8.0.10-cli
#
## Optionally install additionnal packages / extensions or customize
## RUN docker-php-8-install
#
## Include and commit your project files
#ADD ./ /poker
#
## Define the full path of the base command that will be executed
#ENTRYPOINT ["/poker"]
