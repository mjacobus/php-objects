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

    /**
     * Dinamicaly calls method
     * @see PO\Object::__send__
     * @return mixed
     * @throws PO\NoMethodError
     */
    public function send()
    {
        return call_user_func_array(array($this, '__send__'), func_get_args());
    }

    /**
     * Dinamicaly calls method
     * @return mixed
     * @throws PO\NoMethodError
     */
    public final function __send__()
    {
        $args   = func_get_args();
        $method = array_shift($args);

        if ($this->__respondTo__($method)) {
            return call_user_func_array(array($this, $method), $args);
        }

        $message = new String("Undefined method '");
        $message->append($method)->append("' for ")->append($this->getClass());
        throw new NoMethodException($message);
    }

    /**
     * Informs if the given method exists
     * @return boolean
     */
    public final function __respondTo__($method)
    {
        return $this->getMethods()->hasValue($method);
    }

    /**
     * Informs if the given method exists
     * @return boolean
     */
    public function respondTo($method)
    {
        return $this->__respondTo__($method);
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
    public final function __getMethods__()
    {
        $methods = get_class_methods($this);
        $hash = new Hash($methods);
        return $hash;
    }
}
