FROM php:8.0-cli-alpine
COPY . /usr/src/poker
WORKDIR /usr/src/poker

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer2 \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer1 --1 \
    && ln -sf /usr/local/bin/composer2 /usr/local/bin/composer

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer2 install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# run tests
RUN ./vendor/bin/pest
RUN [ "php", "./poker" ]
CMD /bin/sh
