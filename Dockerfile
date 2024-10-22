FROM php:8.2-apache

RUN echo "Acquire::http::Pipeline-Depth 0; \n Acquire::http::No-Cache true; \n Acquire::BrokenProxy    true;" > /etc/apt/apt.conf.d/99fixbadproxy

# Instalar dependências do sistema
RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        zip \
        unzip \
        git || { echo 'Instalação falhou, executando apt-get update novamente'; apt-get update; apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip unzip git; }

# Remover arquivos temporários de cache do apt
RUN rm -rf /var/lib/apt/lists/*

# Habilitar o módulo de reescrita
RUN a2enmod rewrite

# Set the Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/public

# Update the default Apache site configuration
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

# Install PHP extensions.
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql

# Install Composer globally.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create a directory for your Laravel application.
WORKDIR /var/www

# Copy the Laravel application files into the container.
COPY ./laravel-app /var/www

# Install Laravel dependencies using Composer.
RUN composer install --no-interaction --optimize-autoloader

# Set permissions for Laravel.
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 80 for Apache.
EXPOSE 80

# Start Apache web server.
CMD ["apache2-foreground"]

