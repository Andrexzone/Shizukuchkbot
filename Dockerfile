FROM php:8.3-cli-alpine

# Instalar dependencias necesarias
RUN apk add --no-cache git unzip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copiar todo el proyecto
COPY . .

# Instalar paquetes PHP
RUN composer install --no-dev --optimize-autoloader

# Puerto que usa Railway
EXPOSE $PORT

# Iniciar el bot (webhook)
CMD ["php", "-S", "0.0.0.0:8080", "bot.php"]
