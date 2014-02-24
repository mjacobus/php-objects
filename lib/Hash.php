<?php

class Hash implements ArrayAccess, Iterator
{

    /**
     * @var array
     */
    protected $_values = array();

    /**
     * @param array $values The values to initially set to the Hash
     */
    public function __construct(array $values = array())
    {
        $this->_values = $values;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->_values;
    }

    /**
     * ArrayAccess implementation
     */
    public function offsetGet($key, $default = null)
    {
        return isset($this->_values[$key]) ? $this->_values[$key] : $default;
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

    public function compact()
    {
        return $this->reject(function ($value, $key) {
            return $value === '' || $value === null;
        });
    }

    /**
     * Rejects elements if the given function evaluates to true
     *
     * @param $callback callable function
     * @return Hash the new hash containing the non rejected elements
     */
    public function reject($callback)
    {
        $hash = self::create();

        foreach ($this as $key => $value) {
            if ($callback($value, $key) == false) {
                $hash[$key] = $value;
            }
        }

        return $hash;
    }

    /**
     * Select elements if the given function evaluates to true
     *
     * @param $callback callable function
     * @return Hash the new hash containing the non rejected elements
     */
    public function select($callback)
    {
        $hash = self::create();

        foreach ($this as $key => $value) {
            if ($callback($value, $key) == true) {
                $hash[$key] = $value;
            }
        }

        return $hash;
    }

    /**
     * A factory for Hash
     *
     * @param array $params the params to create a new object
     * @return Hash
     */
    public static function create(array $params = array())
    {
        return new Hash;
    }

}
