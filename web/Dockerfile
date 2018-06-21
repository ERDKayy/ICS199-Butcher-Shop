# Dockerfile for the ICS 199
# Local Web Server
#
FROM php:7.1.3-apache
LABEL maintainer="Jason Cumiskey <cumiskey@camosun.bc.ca>"

# install needed pkgs and extensions
# git and zlib1g and zip extension req'd by Composer
# pdo_mysql is the DB driver
# add non-root user to run composer
RUN apt-get update && apt-get install -y \
    git \
    zlib1g-dev \ 
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql \
    && useradd -ms /bin/bash ics199

# switch to non-root user and generate
# composer json and lock; and vendor/ folder
USER ics199
WORKDIR /home/ics199
RUN curl -sS https://getcomposer.org/installer | php \
    && php composer.phar require php \
    && php composer.phar require stripe/stripe-php
# Change back to root so it can bind to port 80
USER root
