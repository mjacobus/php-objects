<?php

namespace POTests;

use PO\Object;

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class ObjectTest extends \PHPUnit_Framework_TestCase
{

    public function testCanGetClass()
    {
        $object = new \Dummy\Object;
        $this->assertEquals('Dummy\Object', $object->getClass());
    }

}
