<?php

require_once 'Object.php';

class MyObject extends Object {}

class ObjectTest extends PHPUnit_Framework_TestCase
{

    public function testCanGetClass()
    {
        $object = new MyObject;
        $this->assertEquals('MyObject', $object->getClass());
    }

}
