FROM johnnyfish/php:7.2-fpm
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get install -y libpng-dev && docker-php-ext-install mbstring zip gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Copy the application files to the container
ADD --chown=www-data:www-data . /var/www/html

WORKDIR /var/www/html

# Increase max file size for uploads
# Also requires an configuration change to the nginx default.conf
RUN { echo 'upload_max_filesize=10M'; } > /usr/local/etc/php/conf.d/overrides.ini;

# Ownership of the app dir for www-data
# RUN chown -R www-data:www-data /var/www/html
