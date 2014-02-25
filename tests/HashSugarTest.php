<?php

require_once 'HashTest.php';

class HashSugarTest extends HashTest
{

    /**
     * @covers Hash::compact()
     */
    public function testItCanCampactAHash()
    {
        $hash = new Hash(array('foo' => 'bar', 'null' => null, 'empty' => ''));
        $compact = $hash->compact();
        $this->assertEquals(array('foo' => 'bar'), $compact->toArray());
        $this->assertHash($compact);
    }

    /**
     * @covers Hash::reject()
     */
    public function testItCanRejectElementsByValue()
    {
        $hash = new Hash(array('foo' => 'foobar', 'bar' => 'barfoo'));

        $filtered = $hash->reject(function($value, $key) {
            return $value === 'barfoo';
        });

        $this->assertEquals(array('foo' => 'foobar'), $filtered->toArray());
        $this->assertHash($filtered);
    }

    /**
     * @covers Hash::reject()
     */
    public function testItCanRejectElementsByKey()
    {
        $hash = new Hash(array('foo' => 'foobar', 'bar' => 'barfoo'));

        $filtered = $hash->reject(function($value, $key) {
            return $key === 'bar';
        });

        $this->assertEquals(array('foo' => 'foobar'), $filtered->toArray());
        $this->assertHash($filtered);
    }

    /**
     * @covers Hash::select()
     */
    public function testItCanSelectElementsByValue()
    {
        $hash = new Hash(array('foo' => 'foobar', 'bar' => 'barfoo'));

        $filtered = $hash->select(function($value, $key) {
            return $value !== 'barfoo';
        });

        $this->assertEquals(array('foo' => 'foobar'), $filtered->toArray());
        $this->assertHash($filtered);
    }

    /**
     * @covers Hash::select()
     */
    public function testItCanSelectElementsByKey()
    {
        $hash = new Hash(array('foo' => 'foobar', 'bar' => 'barfoo'));

        $filtered = $hash->select(function($value, $key) {
            return $key === 'foo';
        });

        $this->assertEquals(array('foo' => 'foobar'), $filtered->toArray());
        $this->assertHash($filtered);
    }

}
