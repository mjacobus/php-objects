<?php

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class Hash extends Object implements ArrayAccess, Iterator, Countable
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
        $hash = $this->create();

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
        $hash = $this->create();

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
        $class = get_called_class();
        return new $class($params);
    }

    /**
     * Maps elements into a new Hash
     *
     * @param function $callback
     * @return Hash
     */
    public function map($callback)
    {
        $hash = $this->create();

        $this->each(function($value, $key) use ($callback, $hash) {
            $hash[] = $callback($value, $key);
        });

        return $hash;
    }

    /**
     * Loop the elements of the Hash
     *
     * @param function $callable
     * @return Hash
     */
    public function each($callable)
    {
        foreach ($this as $key => $value) {
            $callable($value, $key);
        }

        return $this;
    }

    /**
     * Check if has any element
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return $this->count() === 0;
    }

    /**
     * Get the number of elements
     *
     * @return int
     */
    public function count()
    {
        return count($this->toArray());
    }

    /**
     * Get the array keys
     *
     * @return Hash containing the keys
     */
    public function keys()
    {
        return $this->create(array_keys($this->toArray()));
    }

    /**
     * Check object has given key
     *
     * @param string $key
     * @return bool
     */
    public function hasKey($key)
    {
        return $this->offsetExists($key);
    }

}
