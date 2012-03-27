<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Handles the rendering of a single layout column.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Layout_Column extends UI_Container {

    /**
     * @var  int  Holds the width of the layout, which can be
     *            between 1 and 12. Defaults to 6.
     */
    protected $_width = 6;

    /**
     * Sets up the specific configuration items on this class instance.
     *
     * @return  null
     */
    protected function _initialize()
    {
        // Call the parent initialize method
        parent::_initialize();

        // If we have a specific width in the passed configuration
        if (isset($this->_configuration->width)) {
            // Set the width
            $this->set_width($this->_configuration->width);
        }
    }

    /**
     * Returns the current width value.
     *
     * @return  string  The width value.
     */
    public function get_width()
    {
        // Return the width value
        return $this->_width;
    }

    /**
     * Sets the width value to the passed value.
     *
     * @param   int     The width value to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_width($width)
    {
        // Set the width value
        $this->_width = $width;

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

        // Add the width as a 'span[x]' class to the class attribute
        $attributes['class'] = 'container '.(
                isset($attributes['class']) ? $attributes['class'] : ''
            )
        );

        // Return the completed set of attributes
        return $attributes;
    }

} // End Kohana_UI_Layout_Column
