<?php

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
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

    public function testItCanGetDefaultValues()
    {
        $this->assertNull($this->o['foo']);
        $this->assertEquals('bar', $this->o->offsetGet('foo', 'bar'));
    }

    public function testIsCanUnsetKey()
    {
        $hash = new Hash(array('a' => 'b', 'b' => 'c' ));

        $hash->offsetUnset('a');
        $this->assertEquals(array('b' => 'c'), $hash->toArray());

        unset($hash['b']);
        $this->assertEquals(array(), $hash->toArray());
    }

}
