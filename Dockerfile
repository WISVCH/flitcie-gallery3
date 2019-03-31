FROM php:7.3-apache

RUN apt-get update && \
    apt-get install -y --no-install-recommends libjpeg-dev libpng-dev imagemagick && \
    docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr && \
    docker-php-ext-install -j$(nproc) gd mysqli opcache && \
    apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false && \
    rm -rf /var/lib/apt/lists/*

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
		echo 'opcache.memory_consumption=128'; \
		echo 'opcache.interned_strings_buffer=8'; \
		echo 'opcache.max_accelerated_files=4000'; \
		echo 'opcache.revalidate_freq=2'; \
		echo 'opcache.fast_shutdown=1'; \
		echo 'opcache.enable_cli=1'; \
} > /usr/local/etc/php/conf.d/opcache-recommended.ini

# settings for gallery3
RUN { \
		echo 'short_open_tag = On'; \
		echo 'date.timezone = Europe/Amsterdam'; \
} > /usr/local/etc/php/conf.d/gallery3.ini

# make apache2 listen on port 8080 instead of 80 so that we can run the container as non-root
RUN sed -i 's/:80/:8080/g' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's/Listen 80/Listen 8080/g' /etc/apache2/ports.conf

RUN a2enmod rewrite

COPY gallery3/ /var/www/html/

# run apache2 as non-root
RUN useradd --no-log-init -r -g www-data --uid=4001 flitcie
ENV APACHE_RUN_USER=flitcie
ENV APACHE_RUN_GROUP=www-data
USER 4001:33
