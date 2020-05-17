FROM php:7.4-cli-alpine3.11

COPY ./src/* /app/
CMD [ "php", "/app/testdns.php" ]
