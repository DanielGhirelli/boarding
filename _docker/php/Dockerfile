FROM php:8.2-apache

# Make sure the applepay.so extension is in the php.ini file, so it can get copied to the default ini
ADD ./php.ini /usr/local/etc/php/conf.d

WORKDIR /var/www/html

RUN apt-get update \
  && apt-get install -y  \
    libcurl4-gnutls-dev  \
    libmcrypt-dev  \
    libxml2-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    default-mysql-client \
    git \
    zip \
    && docker-php-ext-configure  \
    gd \
        --with-freetype \
        --with-jpeg \
  && docker-php-ext-install \
    gd \
    mysqli \
    pdo pdo_mysql \
    sockets \
    soap \
  && a2enmod rewrite \
  && a2enmod headers \
  && pecl install xdebug-3.3.1

# -------------------------------
ENV XDEBUGINI_PATH=/usr/local/etc/php/conf.d/xdebug.ini

COPY xdebug.ini /tmp/xdebug.ini

RUN echo "zend_extension="`find /usr/local/lib/php/extensions/ -iname 'xdebug.so'` > $XDEBUGINI_PATH \
    && cat /tmp/xdebug.ini >> $XDEBUGINI_PATH

# -------------------------------
ENV OPCACHE_PATH=/usr/local/etc/php/conf.d/opcache.ini

COPY opcache.ini /tmp/opcache.ini

RUN echo "zend_extension="`find /usr/local/lib/php/extensions/ -iname 'opcache.so'` > $OPCACHE_PATH \
    && cat /tmp/opcache.ini >> $OPCACHE_PATH

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php
