<?php

namespace PO;

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class Object
{
    /**
     * Get the class name of the object
     * @return string
     */
    public function getClass()
    {
        return get_class($this);
    }

    /**
     * Object to string
     * @return string
     */
    public function toString()
    {
        return (string) $this;
    }

}
