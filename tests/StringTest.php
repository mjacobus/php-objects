<?php

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class StringTest extends PHPUnit_Framework_TestCase
{

    protected $o;

    public function setUp()
    {
        $this->o = new String();
    }

    /**
     * @covers String::__toString()
     */
    public function testItCanBeConvertedToString()
    {
        $string = new String('hello');
        $this->assertEquals('hello world', $string . ' world');
    }

    /**
     * @covers String::append()
     */
    public function testItCanAppendString()
    {
        $this->o->append('abc')->append(new String('de'));
        $this->assertEquals('abcde', (string) $this->o);
    }

}
