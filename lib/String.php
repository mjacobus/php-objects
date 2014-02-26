<?php

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class String extends Object
{

    protected $_content;

    /**
     * @param string $string
     */
    public function __construct($string = '')
    {
        $this->_content = (string) $string;
    }

    /**
     * Append text to the string
     * @param string $string
     */
    public function append($string)
    {
        $this->_content .= $string;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->_content;
    }
}
