FROM php:8.4-fpm

# Install System Dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    zip \
    unzip \
    supervisor \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Configure & Install PHP Extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
        opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js 20 (LTS) for Vite Asset Building
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Set Working Directory
WORKDIR /var/www/pesantren-ppdb

# Copy Supervisor Configuration & Entrypoint Script
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose PHP-FPM and Reverb Ports
EXPOSE 9000 8080 8081

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
