<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Simple wrapper for Form Inputs and Labels.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Form_Control_Group extends UI_Container {

    /**
     * @var  string  Holds the label text.
     */
    protected $_label = NULL;

    /**
     * @var  string  Holds the form field name the label points to.
     */
    protected $_for = NULL;

    /**
     * @var  string  Holds the form field name the label points to.
     */
    protected $_help_text = NULL;

    /**
     * Sets up the specific configuration items on this class instance.
     *
     * @return  null
     */
    protected function _initialize()
    {
        // Call the parent initialize method
        parent::_initialize();

        // If the configuration data has a label text property
        if (isset($this->_configuration->label)) {
            // Set the label text
            $this->set_label($this->_configuration->label);
        }

        // If the configuration data has a for property
        if (isset($this->_configuration->for)) {
            // Set the for property
            $this->set_for($this->_configuration->for);
        }

        // If the configuration data has a help text property
        if (isset($this->_configuration->help_text)) {
            // Set the help text property
            $this->set_help_text($this->_configuration->help_text);
        }
    }

    /**
     * Returns the current label text.
     *
     * @return  string  The label text value.
     */
    public function get_label()
    {
        // Return the label text value
        return $this->_label;
    }

    /**
     * Sets the label text to the passed value.
     *
     * @param   string  The label text to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_label($label)
    {
        // Set the label text value
        $this->_label = $label;

        // Return a reference to this class instance
        return $this;
    }

    /**
     * Returns the current for value.
     *
     * @return  string  The for value.
     */
    public function get_for()
    {
        // Return the for value
        return $this->_for;
    }

    /**
     * Sets the for value to the passed value.
     *
     * @param   string  The for value to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_for($for)
    {
        // Set the for value
        $this->_for = $for;

        // Return a reference to this class instance
        return $this;
    }

    /**
     * Returns the current help text.
     *
     * @return  string  The help text value.
     */
    public function get_help_text()
    {
        // Return the help text value
        return $this->_help_text;
    }

    /**
     * Sets the help text to the passed value.
     *
     * @param   string  The help text to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_help_text($help_text)
    {
        // Set the help text value
        $this->_help_text = $help_text;

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

        // Add the control-group class
        $attributes['class'] = trim(
            'control-group'.' '.(
                isset($attributes['class']) ? $attributes['class'] : ''
            )
        );

        // Return the completed set of attributes
        return $attributes;
    }

} // End Kohana_UI_Form_Control_Group
