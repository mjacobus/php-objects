<?php

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class HashTest extends PHPUnit_Framework_TestCase
{
    public function assertHash($object)
    {
        $object = new Hash;
        $this->assertInstanceOf('Hash', $object);
    }
}
