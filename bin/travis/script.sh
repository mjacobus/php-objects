#!/bin/bash

phpunit --configuration=tests/phpunit.xml

php --version | grep 5.5 > /dev/null

if (( $? == 0 )); then
  echo -en "\n\nChecking code standard..."
  phpcs --standard=Zend lib

  if (( $? == 0 )); then
    echo -en '\E[32m'"\033[1mPASSED!\033[0m\n\n" # Green
  else
    echo   -en '\E[31;47m'"\033[1mFAILED!\033[0m\n\n"   # Red
    exit 1
  fi
fi
