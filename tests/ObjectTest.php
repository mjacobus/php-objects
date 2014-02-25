<?php

class MyObject extends Object {}

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class ObjectTest extends PHPUnit_Framework_TestCase
{

    public function testCanGetClass()
    {
        $object = new MyObject;
        $this->assertEquals('MyObject', $object->getClass());
    }

}
