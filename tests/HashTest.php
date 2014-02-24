<?php

require_once 'Hash.php';

class HashTest extends PHPUnit_Framework_TestCase
{
    protected $o;

    public function setUp()
    {
        $this->o = new Hash;
    }
}
