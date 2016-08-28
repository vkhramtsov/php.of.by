#!/usr/bin/env sh
# We should deploy only build for php 7
if [ "${TRAVIS_PULL_REQUEST}" = "false" ] && [ $(phpenv version-name) = "7.0" ]; then
    eval "$(ssh-agent -s)"
    chmod 600 .travis/deploy.key
    ssh-add .travis/deploy.key
    scp package.tgz $DEPLOY_USER@$DEPLOY_HOST:$DEPLOY_PATH
    ssh $DEPLOY_USER@$DEPLOY_HOST $DEPLOY_PATH/deploy.sh
    ssh $DEPLOY_USER@$DEPLOY_HOST export\ SYMFONY_ENV=prod
    ssh $DEPLOY_USER@$DEPLOY_HOST php\ ~/php.of.by/builds/current/bin/console\ doctrine:migrations:migrate
fi
