<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

$libPath   = realpath(dirname(__FILE__) . '/../lib/');
$testsPath = realpath(dirname(__FILE__) . '/../tests/');

set_include_path(implode(PATH_SEPARATOR, array(
    $libPath,
    $testsPath,
    get_include_path()
)));

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';

    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }

    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    @include $fileName;
}

spl_autoload_register('autoload');
