<?php

$libPath   = realpath(dirname(__FILE__) . '/../lib/');
$testsPath = realpath(dirname(__FILE__) . '/../tests/');

set_include_path(implode(PATH_SEPARATOR, array(
    $libPath,
    get_include_path()
)));
