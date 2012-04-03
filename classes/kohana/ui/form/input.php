<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Parent class for all form inputs.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Form_Input extends UI_Container {

    /**
     * @var  string  Holds current value of the form field.
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

        // If the configuration data has a value property
        if (isset($this->_configuration->value)) {
            // Set the value
            $this->set_value($this->_configuration->value);
        }
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

        // Add the value attribute
        $attributes['value'] = (string) $this->get_value();

        // Return the completed set of attributes
        return $attributes;
    }

} // End Kohana_UI_Form_Input
