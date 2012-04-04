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
     * @var  string  Holds name of the form field.
     */
    protected $_name = NULL;

    /**
     * @var  string  Holds current value of the form field.
     */
    protected $_value = NULL;

    /**
     * @var  array  Holds any validation rules assigned to the form field.
     */
    protected $_validation = NULL;

    /**
     * Sets up the specific configuration items on this class instance.
     *
     * @return  null
     */
    protected function _initialize()
    {
        // Call the parent initialize method
        parent::_initialize();

        // If the configuration data has a name property
        if (isset($this->_configuration->name)) {
            // Set the name
            $this->set_name($this->_configuration->name);
        }

        // If the configuration data has a value property
        if (isset($this->_configuration->value)) {
            // Set the value
            $this->set_value($this->_configuration->value);
        }

        // If the configuration data has a set of validation options
        if (isset($this->_configuration->validation)) {
            // Set the validation options
            $this->set_validation($this->_configuration->validation);
        }
    }

    /**
     * Returns the current name.
     *
     * @return  string  The name.
     */
    public function get_name()
    {
        // Return the name
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
        // Set the name
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

    /**
     * Returns the current set of validation options.
     *
     * @return  array  The validation options.
     */
    public function get_validation()
    {
        // Return the validation
        return $this->_validation;
    }

    /**
     * Sets the validation options.
     *
     * @param   array   The validation options to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_validation($validation)
    {
        // Set the validation options
        $this->_validation = $validation;

        // Return a reference to this class instance
        return $this;
    }

    /**
     * Attempts to load the value of this form input from the passed data
     * object/array. If nothing is passed in, this method attempts to find the
     * data in the $_POST superglobal.
     *
     * @param   mixed   Optional. An array or object with key/value pairs. If
     *                  a key is found matching the name of this form field,
     *                  this method uses its value. If nothing is passed in,
     *                  this method attempts to use the $_POST superglobal.
     * @return  object  A reference to this class instance.
     */
    public function load($data = NULL)
    {
        // If no data was provided, use the $_POST superglobal
        $data = isset($data) ? $data : $_POST;

        // Convert the passed data into an array so we know what syntax to
        // use, then make sure all of the keys are converted to lowercase
        $data = array_change_key_case((array) $data);

        // Grab the name of this form field and convert it to lowercase
        $name = strtolower($this->get_name());

        // If there is not a key in the data array with this name
        if ( ! isset($data[$name])) {
            // Return a reference to this class instance
            return $this;
        }

        // Set the value
        $this->set_value($data[$name]);

        // Return a reference to this class instance
        return $this;
    }

    /**
     * Attempts to validate this form field using the validation options
     * configured on this class instance.
     *
     * @return  object  An object with an array of errors.
     */
    public function validate()
    {

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

        // Add the name attribute
        $attributes['name'] = (string) $this->get_name();

        // Add the value attribute
        $attributes['value'] = (string) $this->get_value();

        // Return the completed set of attributes
        return $attributes;
    }

} // End Kohana_UI_Form_Input
