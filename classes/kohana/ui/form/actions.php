<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Simple wrapper for Form buttons.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Form_Actions extends UI_Container {

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

        // Add the form-actions class
        $attributes['class'] = trim(
            'form-actions'.' '.(
                isset($attributes['class']) ? $attributes['class'] : ''
            )
        );

        // Return the completed set of attributes
        return $attributes;
    }

} // End Kohana_UI_Form_Actions
