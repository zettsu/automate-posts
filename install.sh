#!/usr/bin/env bash

echo 'Sudo its needed'
echo 'Creating needed diresctories for enviroment for selenium.';
echo 'This script will not install xvfb server';

DIRECTORY="/etc/selenium/"
CURRENT_PATH="$(pwd)"
SELENIUM_JAR="/bin/*"
BIN_PATH="/bin/"
USR_BIN="/usr/bin/"
SERVICES_DIR="/etc/init.d/"
SCRIPTS_DIR="/scripts/"
SELENIUM_SCRIPT="selenium"
XVFB_SCRIPT="xvfb.sh"
CHROME_DRIVER="chromedriver"

if [ ! -d "$DIRECTORY" ]; then
  mkdir $DIRECTORY;
fi

COPY="$CURRENT_PATH$SELENIUM_JAR  $DIRECTORY"
echo 'copying selenium JAR';
cp -Rf $COPY;

echo 'copying binaries chromedriver';

cp $CURRENT_PATH$BIN_PATH$CHROME_DRIVER $USR_BIN;

echo 'copying selenium shell scripts';
cp $CURRENT_PATH$SCRIPTS_DIR$SELENIUM_SCRIPT $SERVICES_DIR;
echo 'copying xvfb shell script';
cp $CURRENT_PATH$SCRIPTS_DIR$XVFB_SCRIPT $SERVICES_DIR;


