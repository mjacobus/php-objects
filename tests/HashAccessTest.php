<?php

require_once 'HashTest.php';

class HashAccessTest extends HashTest
{

    public function testItCanBeAccessWithHash()
    {
        $this->assertFalse(isset($this->o['foo']));
        $this->o['foo'] = 'bar';
        $this->assertTrue(isset($this->o['foo'])).
        $this->assertEquals('bar', $this->o['foo']);
    }

    public function testItImplementsIterator()
    {
        $params = array('foo' => 'bar', 'jon' => 'doe');
        $hash = new Hash($params);

        $values = array();

        foreach ($hash as $key => $value) {
            $values[$key] = $value;
        }

        $this->assertEquals($params, $values);
    }

}
