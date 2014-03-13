<?php

namespace POTests;

use PO\Hash;

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class HashTest extends \PHPUnit_Framework_TestCase
{

    public function assertHash($object)
    {
        // $object = new Hash;
        $this->assertInstanceOf('PO\Hash', $object);
    }

}
