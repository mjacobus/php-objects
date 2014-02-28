<?php

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class StringTest extends PHPUnit_Framework_TestCase
{

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
        $string = new String;
        $string->append('abc')->append(new String('de'));
        $this->assertEquals('abcde', (string) $string);
    }

    /**
     * Data Provider
     */
    public function caseProvider()
    {
        return array(
            array('abc', 'ABC'),
            array('saúdações', 'SAÚDAÇÕES'),
        );
    }

    /**
     * @dataProvider caseProvider
     * @covers String::toUpperCase()
     */
    public function testToUppercase($lower, $upper)
    {
        $string = new String($lower);
        $this->assertEquals($upper, $string->toUpperCase());
        $this->assertInstanceOf('String', $string->toUpperCase());
    }

    /**
     * @dataProvider caseProvider
     * @covers String::toLowerCase()
     */
    public function testToLowerCase($lower, $upper)
    {
        $string = new String($upper);
        $this->assertEquals($lower, $string->toLowerCase());
        $this->assertInstanceOf('String', $string->toLowerCase());
    }

    /**
     * Data Provider
     */
    public function parameterizedProvider()
    {
        return array(
            array('Foo Bar', 'foo-bar', '-'),
            array('Foo Bar', 'foo_bar', '_'),
            array('M!@#$%)ab C', 'mab-c', '-'),
        );
    }

    /**
     * @dataProvider parameterizedProvider
     * @covers String::parameterize()
     */
    public function testParameterize($normal, $parameterized, $separator)
    {
        $string = new String($normal);
        $this->assertEquals($parameterized, $string->parameterize($separator));
        $this->assertInstanceOf('String', $string->toLowerCase());
    }

    /**
     * Data Provider
     */
    public function providerForGsub()
    {
        return array(
            array('abcdabc', 'a', 'A', 'AbcdAbc'),
            array('abcdabc', '/[ac]/', 'A', 'AbAdAbA'),
        );
    }

    /**
     * @dataProvider providerForGsub
     * @covers String::gsub()
     */
    public function testGsub($string, $find, $replacement, $expected)
    {
        $string = new String($string);
        $result = $string->gsub($find, $replacement);
        $this->assertEquals($expected, $result);
        $this->assertInstanceOf('String', $result);
    }

    public function testSplit()
    {
        $string   = new String('a, b, c');
        $expected = array('a', 'b', 'c');
        $split    = $string->split(', ');
        $this->assertEquals($expected, $split->toArray());
        $this->assertInstanceOf('String', $split->first());
    }

}
