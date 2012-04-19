<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Handles the rendering of the visual page title component.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Page_Title extends UI_Component {

    /**
     * @var  string  Holds the title text to display.
     */
    protected $_title = NULL;

    /**
     * @var  string  Holds the description.
     */
    protected $_description = NULL;

    /**
     * Sets up the specific configuration items on this class instance.
     *
     * @return  null
     */
    protected function _initialize()
    {
        // Call the parent initialize method
        parent::_initialize();

        // If we have a title in the passed configuration
        if (isset($this->_configuration->title)) {
            // Set the title
            $this->set_title($this->_configuration->title);
        }

        // If we have a description in the passed configuration
        if (isset($this->_configuration->description)) {
            // Set the description
            $this->set_description($this->_configuration->description);
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

    /**
     * Returns the current description.
     *
     * @return  string  The description value.
     */
    public function get_description()
    {
        // Return the description value
        return $this->_description;
    }

    /**
     * Sets the description to the passed value.
     *
     * @param   string  The description to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_description($description)
    {
        // Set the description value
        $this->_description = $description;

        // Return a reference to this class instance
        return $this;
    }

} // End Kohana_UI_Page_Title
