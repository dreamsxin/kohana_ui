<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Provides methods for working with the results of ui queries.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Query_Result {

    /**
     * @var  array  Holds an array of user interface objects.
     */
    protected $_objects = array();

    /**
     * Accepts an array of user interface objects to work with.
     *
     * @param  array  An array of user interface objects.
     */
    public function __construct($objects)
    {
        // Store the passed objects array on this class instance
        $this->_objects = $objects;
    }

    /**
     * Returns the first item in the objects array and removes it.
     *
     * @return  object  A reference to the first user interface
     *                  object in the objects array.
     */
    public function shift()
    {
        // Shift the first item out of the the objects array
        return array_shift($this->_objects);
    }

    /**
     * Returns the last item in the objects array and removes it.
     *
     * @return  object  A reference to the last user interface
     *                  object in the objects array.
     */
    public function pop()
    {
        // Pop the last item off the end of the objects array
        return array_pop($this->_objects);
    }

    /**
     * Returns all of the matched user interface objects in an array.
     *
     * @return  array  All of the user interface objects.
     */
    public function matches()
    {
        // Return all of the user interface objects
        return $this->_objects;
    }

    /**
     * Returns the number of matched items in the objects array
     *
     * @return  int  The count of matched user interface objects.
     */
    public function count()
    {
        // Return the count of the user interface objects
        return count($this->_objects);
    }

    /**
     * If a method was called that we do not have a local definition for.
     *
     * @param   string  The method name that was called.
     * @param   array   The array of arguments that were passed to the method.
     * @return  mixed   The result of the called method or a reference to
     *                  this class instance.
     */
    public function __call($name, $arguments)
    {
        // Loop over all of the objects
        foreach ($this->_objects as $object) {
            // If the requested method is not defined on the current object
            if ( ! method_exists($object, $name)) {
                // Move on to the next object
                continue;
            }

            // Attempt to call the requested method on the current object
            $result = call_user_func_array(array($object, $name), $arguments);

            // If the method name did not start with 'get_'
            if (substr($name, 0, 4) !== 'get_') {
                // Move on to the next object
                continue;
            }

            // Return the result of the call
            return $result;
        }

        // Return a reference to this class instance
        return $this;
    }

} // End Kohana_UI_Query_Result
