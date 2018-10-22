#!/bin/bash

# kill 0 sends the signal to all processes in the current process group too.
trap "stty echo;kill 0;echo;exit" SIGINT SIGTERM EXIT

# Selenium server path. codeception, php and jva are expected to be defined in PATH
selenium_jar="selenium.jar"
selenium_log="log/selenium.log"

# Color definitions
bold="\033[1m"
reset="\033[0m"
red="\033[31m"
green="\033[32m"
bg_red="\033[41m"
bg_green="\033[42m"


######
# Start servers
######


start_selenium() {
    echo -n "Starting selenium server"

    if [ ! -f ${selenium_jar} ]; then
        echo
        echo -e ${bg_red}${bold}"Selenium server JAR file not found: ${selenium_jar}"${reset}
        kill 0
        exit 1;
    fi

    java -jar ${selenium_jar} &> ${selenium_log} &

    # wait for selenium server to spin up! (add -v for verbose output)
    i=0
    while ! nc -z localhost 4444; do
        sleep 1
        echo -n "."
        ((i++))
        if [ ${i} -gt 20 ]; then
            echo
            echo -e ${bg_red}${bold}"Selenium server connection timed out"${reset}
            exit 1
        fi
    done
}

usage() {
    echo -e "Usage:\n  $0 -w\tWeb server only\n  $0 -s \tSelenium server only\n  $0 \t\tStart everything"
    exit 1
}


# Hide user input
stty -echo

# Action!
#if [ "$*" == "-w" ];then start_web
#elif [ "$*" == "-s" ];then start_selenium
#elif [ $* ];then usage
#else
    #start_web
start_selenium
#fi



echo
echo -e ${bg_green}${bold}"   READY   "${reset}

# wait forever (until user interrupts)
# other approaches doesn't allow SIGINT to be trapped
tail -f /dev/null