FROM ghcr.io/maymeow/php-ci-cd/php-ci-cd:8.1.6-cs-git-psalm AS build-env

WORKDIR /app

COPY . /app

RUN composer install --no-ansi --no-dev --no-interaction --no-plugins --no-progress --optimize-autoloader --no-scripts

RUN phar-composer build && chmod +x action-mattermost-notify.phar

FROM php:8.1.6-cli-alpine

COPY --from=build-env /app/action-mattermost-notify.phar /usr/local/bin/action-mattermost-notify

COPY --from=build-env /app/entrypoint.sh /entrypoint.sh

RUN action-mattermost-notify list

ENTRYPOINT ["/entrypoint.sh"]
