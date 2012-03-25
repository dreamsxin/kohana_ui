<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Handles the rendering and data management tasks for a form input.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Input extends UI_Container {

    /**
     * @var  string  Holds the name of the input.
     */
    protected $_name = NULL;

    /**
     * @var  string  Holds the value of the input.
     */
    protected $_value = NULL;

    /**
     * Sets up the specific configuration items on this class instance.
     *
     * @return  null
     */
    protected function _initialize()
    {
        // Call the parent initialize method
        parent::_initialize();

        // If the configuration data has an name property
        if (isset($this->_configuration->name)) {
            // Set the name
            $this->set_name($this->_configuration->name);
        }

        // If the configuration data has an value property
        if (isset($this->_configuration->value)) {
            // Set the value
            $this->set_value($this->_configuration->value);
        }
    }

    /**
     * Returns the current name.
     *
     * @return  string  The name value.
     */
    public function get_name()
    {
        // Return the name value
        return $this->_name;
    }

    /**
     * Sets the name to the passed value.
     *
     * @param   string  The name to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_name($name)
    {
        // Set the name value
        $this->_name = $name;

        // Return a reference to this class instance
        return $this;
    }

    /**
     * Returns the current value.
     *
     * @return  string  The value.
     */
    public function get_value()
    {
        // Return the value
        return $this->_value;
    }

    /**
     * Sets the value to the passed value.
     *
     * @param   string  The value to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_value($value)
    {
        // Set the value
        $this->_value = $value;

        // Return a reference to this class instance
        return $this;
    }

} // End Kohana_UI_Input
