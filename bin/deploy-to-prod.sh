#!/usr/bin/env sh
# We should deploy only build for php 7
if [ "${TRAVIS_PULL_REQUEST}" = "false" ] && [ $(phpenv version-name) = "7.0" ]; then
    eval "$(ssh-agent -s)"
    chmod 600 .travis/deploy.key
    ssh-add .travis/deploy.key
    mkdir build
    mv * build
    tar -czf package.tgz build
    scp package.tgz $DEPLOY_USER@$DEPLOY_HOST:$DEPLOY_PATH
    ssh $DEPLOY_USER@$DEPLOY_HOST $DEPLOY_PATH/deploy.sh
fi
