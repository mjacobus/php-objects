#!/bin/bash

phpunit --configuration=tests/phpunit.xml

php --version | grep 5.5 > /dev/null

if (( $? == 0 )); then
  echo "Installing PHP Code Sniffer"

  pyrus install pear/PHP_CodeSniffer
  phpenv rehash

  echo "Checking code standard"
  phpcs --standard=Zend lib
fi
