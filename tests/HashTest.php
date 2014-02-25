<?php

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class HashTest extends PHPUnit_Framework_TestCase
{
    protected $o;

    public function setUp()
    {
        $this->o = new Hash;
    }

    public function assertHash($object)
    {
        $this->assertInstanceOf('Hash', $object);
    }
}
