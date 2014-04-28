<?php

namespace POTests;

use PO\Object;
use Dummy\Object as Dummy;

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class ObjectTest extends \PHPUnit_Framework_TestCase
{

    public function testCanGetClass()
    {
        $object = new Dummy;
        $this->assertEquals('Dummy\Object', $object->getClass());
    }

    /**
     * @expectedException \PO\NoMethodException
     * @expectedExceptionMessage \
     *    Undefined method 'unexistingMethod' for Dummy\Object
     */
    public function testItThrowsExceptionOnMethodMissing()
    {
        $object = new Dummy;
        $object->unexistingMethod();
    }

    public function testSendWithNoArguments()
    {
        $this->markTestIncomplete('Implement Hash::include');
        $object = new Dummy;
        $this->assertEquals('example one', $object->send('methodOne'));
    }

    public function testGetMethods()
    {
        $object = new Dummy;

        $methods = array('exampleOne', 'exampleTwo', 'exampleThree');

        $objectMethods = $object->getMethods()->toArray();

        foreach ($methods as $method) {
            $this->assertTrue(in_array($method, $objectMethods));
        }

    }

}
