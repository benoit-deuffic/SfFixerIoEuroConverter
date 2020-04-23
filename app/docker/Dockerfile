FROM php:7.3-alpine

COPY . /

CMD sh composer/install.sh
CMD composer install 
CMD php -S 0.0.0.0:80 app/public/index.php
