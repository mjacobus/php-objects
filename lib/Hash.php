<?php

class Hash implements ArrayAccess, Iterator
{

    protected $_values = array();

    public function __construct(array $values = array())
    {
        $this->_values = $values;
    }

    /**
     * ArrayAccess implementation
     */
    public function offsetGet($key, $default = null)
    {
        return isset($this->_values[$key]) ? $this->_values[$key] : null;
    }

    /**
     * ArrayAccess implementation
     */
    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->_values[] = $value;
        } else {
            $this->_values[$key] = $value;
        }

        return $this;
    }

    /**
     * ArrayAccess implementation
     */
    public function offsetExists($key)
    {
        return isset($this->_values[$key]);
    }

    /**
     * ArrayAccess implementation
     */
    public function offsetUnset($key)
    {
        unset($this->_values[$key]);
        return $this;
    }

    /**
     * Iterator implementation
     */
    public function current()
    {
        return current($this->_values);
    }

    /**
     * Iterator implementation
     */
    public function next()
    {
        return next($this->_values);
    }

    /**
     * Iterator implementation
     */
    public function key()
    {
        return key($this->_values);
    }

    /**
     * Iterator implementation
     */
    public function rewind()
    {
        reset($this->_values);
        return $this;
    }

    /**
     * Iterator implementation
     */
    public function valid()
    {
        $key = key($this->_values);
        return ($key !== null && $key !== false);
    }

}
