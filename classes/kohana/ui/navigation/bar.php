<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Handles the rendering of a site navigation bar.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Navigation_Bar extends UI_Container {

    /**
     * Sets up the specific configuration items on this class instance.
     *
     * @return  null
     */
    protected function _initialize()
    {
        // Call the parent initialize method
        parent::_initialize();

        // If the configuration data has a title property
        if (isset($this->_configuration->title)) {
            // Set the title
            $this->set_title($this->_configuration->title);
        }
    }

    /**
     * Returns the current title.
     *
     * @return  string  The title value.
     */
    public function get_title()
    {
        // Return the title value
        return $this->_title;
    }

    /**
     * Sets the title to the passed value.
     *
     * @param   string  The title to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_title($title)
    {
        // Set the title value
        $this->_title = $title;

        // Return a reference to this class instance
        return $this;
    }

} // End Kohana_UI_Navigation_Bar
