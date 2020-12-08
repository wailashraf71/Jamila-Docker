FROM php:7.4-fpm-alpine

WORKDIR /var/www/html


RUN apk update && apk add \
    build-base \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    shadow \
    php-mbstring \
    mysql-client \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl
    
RUN docker-php-ext-install pdo pdo_mysql zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/$
RUN docker-php-ext-install gd

# Install Redis Extension
RUN apk add autoconf && pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis && apk del autoconf

# Copy config
COPY ./php/local.ini /usr/local/etc/php/conf.d/local.ini

# COPY ./src /var/www/html

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Remove Cache
RUN rm -rf /var/cache/apk/*

# Add UID '1000' to www-data
RUN usermod -u 1000 www-data

# Copy existing application directory permissions
# COPY --chown=www-data:www-data . /var/www/html

# Change current user to www
USER root

# RUN chown -R root:www-data /var/www/html/storage
# RUN ["chmod", "+x", "/var/www/html/build.sh"]
# RUN ["chmod", "-R", "755", "/var/www/html/storage"]



# EXPOSE 9000

# CMD ./src/start_script.sh

# COPY ./build.sh /tmp
# ENTRYPOINT ["/tmp/build.sh"]