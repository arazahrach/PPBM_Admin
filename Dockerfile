# ====== Build assets (node) ======
FROM node:20-alpine AS nodebuild
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# ====== PHP + Nginx runtime ======
FROM php:8.3-fpm-alpine

# packages
RUN apk add --no-cache nginx supervisor bash git unzip icu-dev oniguruma-dev libzip-dev \
  && docker-php-ext-install intl pdo pdo_mysql zip

# composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# copy app
COPY . .

# copy built assets into public (Laravel Vite default puts into public/build)
COPY --from=nodebuild /app/public/build ./public/build

# install php deps
RUN composer install --no-dev --optimize-autoloader

# nginx config
COPY conf/nginx/default.conf /etc/nginx/http.d/default.conf

# permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# startup
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80
CMD ["/start.sh"]
