#!/usr/bin/env bash

command -v node >/dev/null 2>&1 || {
  echo "Missing node.js executable, please install node.js, if already installed make sure it can be reached from current environment."
  exit 1
}

CURRENTDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
ARTIFACTS="$CURRENTDIR/../artifacts"
echo $ARTIFACTS
if [ -z ${DEPLOYMENT_SOURCE+x} ]
then DEPLOYMENT_SOURCE=$CURRENTDIR
fi

if [ -z ${DEPLOYMENT_TARGET+x} ]
then DEPLOYMENT_TARGET="$ARTIFACTS/wwwroot"
fi

if [ -z ${NEXT_MANIFEST_PATH+x} ]
then NEXT_MANIFEST_PATH="$ARTIFACTS/manifest"
fi

if [ -z ${PREVIOUS_MANIFEST_PATH+x} ]
then PREVIOUS_MANIFEST_PATH="$ARTIFACTS/manifest"
fi

echo $DEPLOYMENT_SOURCE
echo $DEPLOYMENT_TARGET

command -v kudusync >/dev/null 2>&1 || {
  echo "Installing Kudu Sync on npm"
  npm install kudusync -g --silent
}

# Deployment

echo "Handling PHP Web Site deployment."

echo "source: $DEPLOYMENT_SOURCE"
echo "target: $DEPLOYMENT_TARGET"

if [ -e "$CURRENTDIR/composer.json" ]
then
  echo "Start composer setup"
  if [ ! -e "$CURRENTDIR/composer.phar" ]
  then
    echo "composer not found. Installing..."
    curl -s https://getcomposer.org/installer | eval php
    echo "composer is downloaded"
  else
    echo "composer.phar found! updating..."
    eval php composer.phar self-update
  fi

  echo "Install composer packages now"
  eval php composer.phar install --no-dev
fi

php artisan migrate --force

kudusync -v 50 -f $DEPLOYMENT_SOURCE -t $DEPLOYMENT_TARGET -n $NEXT_MANIFEST_PATH -p $PREVIOUS_MANIFEST_PATH -i ".git;.hg;.deployment;deploy.sh,composer.phar"
