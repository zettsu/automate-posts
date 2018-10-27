#!/usr/bin/env bash

echo 'Sudo its needed'
echo 'Creating needed diresctories for enviroment for selenium.';
echo 'This script will not install xvfb server';

DIRECTORY="/etc/selenium/"
CURRENT_PATH="$(pwd)"
SELENIUM_JAR="/bin/*"
SERVICES_DIR="/etc/init.d/"
SCRIPTS_DIR="/scripts/"
SELENIUM_SCRIPT="selenium"
XVFB_SCRIPT="xvfb.sh"

if [ ! -d "$DIRECTORY" ]; then
  mkdir $DIRECTORY;
fi

COPY="$CURRENT_PATH$SELENIUM_JAR  $DIRECTORY"
cp -Rf $COPY;

cp $CURRENT_PATH$SCRIPTS_DIR$SELENIUM_SCRIPT $SERVICES_DIR
cp $CURRENT_PATH$SCRIPTS_DIR$XVFB_SCRIPT $SERVICES_DIR


