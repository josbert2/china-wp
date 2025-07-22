FROM wordpress:latest

# Instalamos msmtp y certificados
RUN apt-get update \
 && apt-get install -y msmtp ca-certificates \
 && rm -rf /var/lib/apt/lists/*

# Copiamos configuración de msmtp
COPY msmtp.conf /etc/msmtp.conf

# Forzamos sendmail hacia msmtp
RUN echo 'sendmail_path = "/usr/bin/msmtp -t"' \
     >> /usr/local/etc/php/conf.d/sendmail.ini
