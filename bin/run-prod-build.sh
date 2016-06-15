#!/bin/sh
export SYMFONY_ENV=prod && php phing.phar build-prod && export SYMFONY_ENV=
