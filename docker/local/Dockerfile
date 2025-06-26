FROM php:8.4.6-fpm-bullseye

ARG timezone

ENV TIMEZONE=${timezone:-"Asia/Shanghai"}

RUN echo " " > /etc/apt/sources.list \
    && echo "deb http://mirrors.tuna.tsinghua.edu.cn/debian/ bullseye main contrib non-free" >> /etc/apt/sources.list \
    && echo "deb http://mirrors.tuna.tsinghua.edu.cn/debian/ bullseye-updates main contrib non-free" >> /etc/apt/sources.list \
    && echo "deb http://mirrors.tuna.tsinghua.edu.cn/debian/ bullseye-backports main contrib non-free" >> /etc/apt/sources.list \
    && echo "deb http://mirrors.tuna.tsinghua.edu.cn/debian/ bullseye-backports main contrib non-free" >> /etc/apt/sources.list \
    && echo "file_uploads = On" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 64M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "upload_max_filesize = 64M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 64M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time = 600" >> /usr/local/etc/php/conf.d/uploads.ini \
    && apt-get update  \
    && apt-get install -y --no-install-recommends git vim libpng-dev libjpeg-dev libfreetype6-dev libzip-dev cron supervisor\
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pdo_mysql bcmath\
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-ext-install gd \
    && cd /tmp \
    && php -r "copy('https://install.phpcomposer.com/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /bin/composer \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && composer clear


RUN mv /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini \
    &&  echo "* * * * * /usr/local/bin/php /var/www/artisan schedule:run >> /var/log/cron.log 2>&1" | crontab -

WORKDIR /var/www


EXPOSE 9000
CMD ["php-fpm"]

