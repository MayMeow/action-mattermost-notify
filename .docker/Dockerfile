FROM ghcr.io/maymeow/php-ci-cd/php-ci-cd:8.1.6-cs-git-psalm AS build-env

WORKDIR /app

COPY . /app

RUN composer install

RUN phar-composer build && chmod +x action-mattermost-notify.phar

FROM php:8.1.6-cli-alpine

COPY --from=build-env /app/action-mattermost-notify.phar /usr/local/bin/action-mattermost-notify

RUN action-mattermost-notify list
