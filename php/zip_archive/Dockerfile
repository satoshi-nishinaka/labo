FROM php:7.4-cli
COPY scripts /usr/src/
COPY call_all_scripts.sh /usr/shell/
RUN apt-get update && \
  apt-get install -y zip libzip-dev && \
  chmod +x /usr/shell/call_all_scripts.sh && \
  sed -i 's/\r//' /usr/shell/call_all_scripts.sh
RUN docker-php-ext-install zip
WORKDIR /usr/src/
CMD [ "/bin/bash", "/usr/shell/call_all_scripts.sh" ]
