FROM php:7.4-apache

# Extensions yang dibutuhkan CodeIgniter 3 + mysqli
RUN docker-php-ext-install mysqli

# Aktifkan mod_rewrite untuk clean URL CodeIgniter
RUN a2enmod rewrite

# Redam warning "Could not reliably determine server's FQDN"
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Folder khusus untuk session files (terpisah dari /tmp sistem)
# FIX: CodeIgniter 3 memvalidasi session ID dengan regex 40 karakter hex
# (format lama SHA-1), tapi PHP 7.1+ menghapus ini session.hash_function
# yang dulu dipakai CI3 untuk generate ID sepanjang itu. Tanpa ini, CI3
# selalu membuang cookie session-nya sendiri di setiap request -> user
# tidak pernah "tetap login". Paksa PHP generate ID 40-hex-char di sini.
RUN { \
      echo "session.sid_length = 40"; \
      echo "session.sid_bits_per_character = 4"; \
    } > /usr/local/etc/php/conf.d/ci3-session-fix.ini

# Copy source code lab ke webroot Apache
COPY . /var/www/html/

# Pastikan folder uploads, sessions, logs & cache writable oleh Apache
# (HARUS setelah COPY, biar ownership-nya gak ketiban ulang oleh COPY)
RUN mkdir -p /var/www/html/uploads /var/www/sessions /var/www/html/application/logs /var/www/html/application/cache \
    && chown -R www-data:www-data /var/www/html/uploads /var/www/sessions /var/www/html/application/logs /var/www/html/application/cache \
    && chmod -R 775 /var/www/html/application/logs /var/www/html/application/cache

# AllowOverride All supaya .htaccess CodeIgniter jalan
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

EXPOSE 80
