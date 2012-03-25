<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Handles the rendering and data management tasks for a form.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Form extends UI_Container {

    /**
     * @var  string  Holds the form action value.
     */
    protected $_action = NULL;

    /**
     * @var  string  Holds the form method value.
     */
    protected $_method = 'POST';

    /**
     * Sets up the specific configuration items on this class instance.
     *
     * @return  null
     */
    protected function _initialize()
    {
        // Call the parent initialize method
        parent::_initialize();

        // If the configuration data has an action property
        if (isset($this->_configuration->action)) {
            // Set the action
            $this->set_action($this->_configuration->action);
        }

        // If the configuration data has a method property
        if (isset($this->_configuration->method)) {
            // Set the method property
            $this->set_method($this->_configuration->method);
        }
    }

    /**
     * Returns the current action.
     *
     * @return  string  The action value.
     */
    public function get_action()
    {
        // Return the action value
        return $this->_action;
    }

    /**
     * Sets the action to the passed value.
     *
     * @param   string  The action to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_action($action)
    {
        // Set the action value
        $this->_action = $action;

        // Return a reference to this class instance
        return $this;
    }

    /**
     * Returns the current method.
     *
     * @return  string  The method value.
     */
    public function get_method()
    {
        // Return the method value
        return $this->_method;
    }

    /**
     * Sets the method to the passed value.
     *
     * @param   string  The method to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_method($method)
    {
        // Set the method value
        $this->_method = $method;

        // Return a reference to this class instance
        return $this;
    }

    /**
     * Returns the HTML attributes to assign to this component.
     *
     * @return  array  An array of key/value pairs.
     */
    public function get_attributes()
    {
        // Initialize the attributes array with the return value of
        // the parent method
        $attributes = parent::get_attributes();

        // Add the action attribute
        $attributes['action'] = (string) $this->get_action();

        // Add the method attribute
        $attributes['method'] = (string) $this->get_method();

        // Return the completed set of attributes
        return $attributes;
    }

} // End Kohana_UI_Form
