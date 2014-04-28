<?php

namespace PO;

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
abstract class Object
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

    /**
     * Alias to missingMethod()
     *
     * @see PO\Object::methodMissing()
     * @throws PO\NoMethodException
     */
    public function __call($method, $args)
    {
        return $this->methodMissing($method, $args);
    }

    /**
     * Method missing callback
     *
     * @throws PO\NoMethodException
     */
    public function methodMissing($method, $args)
    {
        return $this->send($method, $args);
    }

    public function send($method, $args = null)
    {
        return $this->__send__($method, $args);
    }

    public function __send__($method, $args = null)
    {
        $message = new String("Undefined method '");
        $message->append($method)->append("' for ")->append($this->getClass());

        throw new NoMethodException($message);
    }

    /**
     * Get the methods that the object responds to
     * @see PO\Object::__methods__()
     *
     * @return PO\Hash.
     */
    public function getMethods()
    {
        return $this->__getMethods__();
    }

    /**
     * Get the methods that the object responds to
     *
     * @return PO\Hash.
     */
    public function __getMethods__()
    {
        $methods = get_class_methods($this);
        $hash = new Hash($methods);
        return $hash;
    }
}
