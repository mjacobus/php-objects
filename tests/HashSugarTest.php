<?php

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
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

    /**
     * @covers Hash::map()
     */
    public function testItCanMapElements()
    {
        $hash = new Hash(array('a' => 'b', 'c' => 'd'));

        $mapped = $hash->map(function($value, $key) {
            return $key . $value;
        });

        $expectation = array('ab', 'cd');

        $this->assertEquals($expectation, $mapped->toArray());
    }

    /**
     * @covers Hash::each()
     */
    public function testItIterateViaEach()
    {
        $hash = new Hash(array('a' => 'b', 'c' => 'd'));

        $array = new Hash;

        $hash->each(function($value, $key) use ($array) {
            $array[] = $key;
            $array[] = $value;
        })->each(function($value, $key) use ($array) {
            $array[] = $key;
            $array[] = $value;
        });

        $expectation = array(
            'a', 'b', 'c', 'd',
            'a', 'b', 'c', 'd',
        );

        $this->assertEquals($expectation, $array->toArray());
    }

    /**
     * @covers Hash::create()
     */
    public function testItCanFactoryTheCorrectClass()
    {
        $hash = new Dummy\Hash;
        $created = $hash->create();
        $this->assertInstanceOf('\Dummy\Hash', $created);

        $params = array('a' => 'b');
        $created = $hash->create($params);
        $this->assertEquals($params, $created->toArray());
    }

}
