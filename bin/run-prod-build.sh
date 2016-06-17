#!/usr/bin/env sh
if [ "${TRAVIS_PULL_REQUEST}" = "false" ]; then
    export SYMFONY_ENV=prod && php phing.phar build-prod && export SYMFONY_ENV=
    eval "$(ssh-agent -s)"
    chmod 600 .travis/deploy.key
    ssh-add .travis/deploy.key
    sh ./bin/run-prod-build.sh
    mkdir build
    mv * build
    tar -czf package.tgz build
    scp package.tgz $DEPLOY_USER@$DEPLOY_HOST:$DEPLOY_PATH
    ssh $DEPLOY_USER@$DEPLOY_HOST $DEPLOY_PATH/deploy.sh
fi
