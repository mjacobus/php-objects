#!/bin/bash

phpunit --configuration=tests/phpunit.xml

php --version | grep 5.5 > /dev/null

if (( $? == 0 )); then
  echo ""
  echo -en "Checking lib code standard..."
  phpcs --standard=Zend lib

  if (( $? == 0 )); then
    echo -e '\E[32m'"\033[1mPASSED!\033[0m" # Green
  else
    echo   -e '\E[31;47m'"\033[1mFAILED!\033[0m"   # Red
    exit 1
  fi

  echo -en "Checking tests code standard..."
  phpcs --standard=Zend tests

  if (( $? == 0 )); then
    echo -e '\E[32m'"\033[1mPASSED!\033[0m" # Green
  else
    echo   -e '\E[31;47m'"\033[1mFAILED!\033[0m"   # Red
    exit 1
  fi
fi
