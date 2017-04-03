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

if [[ ! -n "$NEXT_MANIFEST_PATH" ]]
then
  NEXT_MANIFEST_PATH=$ARTIFACTS/manifest

  if [[ ! -n "$PREVIOUS_MANIFEST_PATH" ]]
  then
    PREVIOUS_MANIFEST_PATH=$NEXT_MANIFEST_PATH
  fi
fi

echo $DEPLOYMENT_SOURCE
echo $DEPLOYMENT_TARGET

command -v kudusync >/dev/null 2>&1 || {
  echo "Installing Kudu Sync on npm"
  npm install kudusync -g --silent
}

# Deployment

echo "Handling PHP Web Site deployment."

if [ -e "$CURRENTDIR/composer.json" ]
then
  echo "Start composer setup"
  php -v
  if [ ! -e "$CURRENTDIR/composer.phar" ]
  then
    echo "composer not found. Downloading..."
    curl -s https://getcomposer.org/installer | php
    echo "composer is downloaded"
  else
    echo "composer.phar found! updating..."
    php composer.phar self-update
  fi

  echo "Install composer packages now"
  php composer.phar install --no-dev
fi

php artisan migrate --force

echo "source: $DEPLOYMENT_SOURCE"
echo "target: $DEPLOYMENT_TARGET"
echo "next manifest: $NEXT_MANIFEST_PATH"
echo "prev manifest: $PREVIOUS_MANIFEST_PATH"
kudusync -v 50 -f $DEPLOYMENT_SOURCE -t $DEPLOYMENT_TARGET -n $NEXT_MANIFEST_PATH -p $PREVIOUS_MANIFEST_PATH -i ".git;.hg;.deployment;deploy.sh,composer.phar"
