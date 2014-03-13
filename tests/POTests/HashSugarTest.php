<?php

namespace POTests;

use PO\Hash;

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class HashSugarTest extends HashTest
{

    /**
     * @covers PO\Hash::compact()
     */
    public function testItCanCampactAHash()
    {
        $hash = new Hash(array('foo' => 'bar', 'null' => null, 'empty' => ''));
        $compact = $hash->compact();
        $this->assertEquals(array('foo' => 'bar'), $compact->toArray());
        $this->assertHash($compact);
    }

    /**
     * @covers PO\Hash::reject()
     */
    public function testItCanRejectElementsByValue()
    {
        $hash = new Hash(array('foo' => 'foobar', 'bar' => 'barfoo'));

        $filtered = $hash->reject(
            function($value, $key) {
                return $value === 'barfoo';
            }
        );

        $this->assertEquals(array('foo' => 'foobar'), $filtered->toArray());
        $this->assertHash($filtered);
    }

    /**
     * @covers PO\Hash::reject()
     */
    public function testItCanRejectElementsByKey()
    {
        $hash = new Hash(array('foo' => 'foobar', 'bar' => 'barfoo'));

        $filtered = $hash->reject(
            function($value, $key) {
                return $key === 'bar';
            }
        );

        $this->assertEquals(array('foo' => 'foobar'), $filtered->toArray());
        $this->assertHash($filtered);
    }

    /**
     * @covers PO\Hash::select()
     */
    public function testItCanSelectElementsByValue()
    {
        $hash = new Hash(array('foo' => 'foobar', 'bar' => 'barfoo'));

        $filtered = $hash->select(
            function($value, $key) {
                return $value !== 'barfoo';
            }
        );

        $this->assertEquals(array('foo' => 'foobar'), $filtered->toArray());
        $this->assertHash($filtered);
    }

    /**
     * @covers PO\Hash::select()
     */
    public function testItCanSelectElementsByKey()
    {
        $hash = new Hash(array('foo' => 'foobar', 'bar' => 'barfoo'));

        $filtered = $hash->select(
            function($value, $key) {
                return $key === 'foo';
            }
        );

        $this->assertEquals(array('foo' => 'foobar'), $filtered->toArray());
        $this->assertHash($filtered);
    }

    /**
     * @covers PO\Hash::map()
     */
    public function testItCanMapElements()
    {
        $hash = new Hash(array('a' => 'b', 'c' => 'd'));

        $mapped = $hash->map(
            function($value) {
                return $value;
            }
        );

        $expectation = array('b', 'd');

        $this->assertEquals($expectation, $mapped->toArray());
    }

    /**
     * @covers PO\Hash::each()
     */
    public function testItIterateViaEach()
    {
        $hash = new Hash(array('a' => 'b', 'c' => 'd'));

        $array = new Hash;

        $hash->each(
            function($value) use ($array) {
                $array[] = $value;
            }
        )->each(
            function($value) use ($array) {
                $array[] = $value;
            }
        );

        $expectation = array( 'b', 'd', 'b', 'd');

        $this->assertEquals($expectation, $array->toArray());
    }

    /**
     * @covers PO\Hash::each()
     */
    public function testItIterateViaEachWithIndex()
    {
        $hash = new Hash(array('a' => 'b', 'c' => 'd'));

        $array = new Hash;

        $hash->each(
            function($value, $key) use ($array) {
                $array[] = $key;
                $array[] = $value;
            }
        )->each(
            function($value, $key) use ($array) {
                $array[] = $key;
                $array[] = $value;
            }
        );

        $expectation = array(
            'a', 'b', 'c', 'd',
            'a', 'b', 'c', 'd',
        );

        $this->assertEquals($expectation, $array->toArray());
    }

    /**
     * @covers PO\Hash::create()
     */
    public function testItCanFactoryTheCorrectClass()
    {
        $hash = new \Dummy\Hash;
        $created = $hash->create();
        $this->assertInstanceOf('\Dummy\Hash', $created);

        $params = array('a' => 'b');
        $created = $hash->create($params);
        $this->assertEquals($params, $created->toArray());
    }

    /**
     * @covers PO\Hash::isEmpty()
     */
    public function testIsEmpty()
    {
        $hash = new Hash(array('foo' => 'bar'));

        $this->assertFalse($hash->isEmpty());
        $this->assertFalse(empty($hash));

        unset($hash['foo']);

        $this->assertTrue($hash->isEmpty());
        // $this->assertTrue(empty($hash));
    }

    /**
     * @covers PO\Hash::count()
     */
    public function testCount()
    {
        $hash = new Hash(array('foo' => 'bar'));

        $this->assertEquals(1, $hash->count());
        $this->assertEquals(1, count($hash));


        unset($hash['foo']);

        $this->assertEquals(0, $hash->count());
        $this->assertEquals(0, count($hash));
    }

    /**
     * @covers PO\Hash::keys()
     */
    public function testKeys()
    {
        $hash = new Hash(
            array(
                'foo' => 'foobar',
                'bar' => 'barfoo'
            )
        );

        $expected = array('foo', 'bar');

        $this->assertEquals($expected, $hash->keys()->toArray());
        $this->assertInstanceOf('PO\String', $hash->keys()->first());
    }

    /**
     * @covers PO\Hash::hasKey()
     */
    public function testHasKey()
    {
        $hash = new Hash(array('foo' => 'foobar'));

        $this->assertTrue($hash->hasKey('foo'));
        $this->assertFalse($hash->hasKey('bar'));
    }

    /**
     * @covers PO\Hash::delete()
     */
    public function testDelete()
    {
        $object = new Hash;
        $hash = Hash::create(array('foo' => $object, 'b' => 'bar'));
        $deleted = $hash->delete('foo');

        $this->assertSame($object, $deleted);
        $this->assertEquals(array('b' => 'bar'), $hash->toArray());
    }

    /**
     * @covers PO\Hash::fetch()
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Invalid key 'bar'
     */
    public function testFetch()
    {
        $hash = Hash::create(array('foo' => 'bar'));
        $this->assertEquals('bar', $hash->fetch('foo'));
        $hash->fetch('bar');
    }

    /**
     * @covers PO\Hash::valuesAt()
     */
    public function testValuesAt()
    {
        $hash = new Hash(array('a' => 'b', 'c' => 'b'));

        $expected = array('b', null);

        $this->assertEquals(
            $expected, 
            $hash->valuesAt(array('a', 'b'))->toArray()
        );
        $this->assertEquals($expected, $hash->valuesAt('a', 'b')->toArray());
    }

    /**
     * @covers PO\Hash::join()
     */
    public function testJoin()
    {
        $hash = new Hash(array('a' => 'b', 'c' => 'd' ));

        $this->assertEquals('bd', $hash->join());
        $this->assertEquals('b, d', $hash->join(', '));
    }

    /**
     * @covers PO\Hash::first()
     */
    public function testFirst()
    {
        $hash = new Hash(array('a', 'b'));
        $this->assertEquals('a', $hash->first());
    }

    /**
     * @covers PO\Hash::last()
     */
    public function testLast()
    {
        $hash = new Hash(array('a', 'b'));
        $this->assertEquals('b', $hash->last());
    }

}
