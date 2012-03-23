<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Handles the rendering of a single link. Usually an 'a' tag, unless the
 * corresponding view has been modified.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Link extends UI_Container {

    /**
     * @var  string  Holds the HREF for the link.
     */
    protected $_href = NULL;

    /**
     * @var  string  Holds the link title.
     */
    protected $_title = NULL;

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

        // If we have an href value in the passed configuration
        if (isset($this->_configuration->href)) {
            // Set the href value
            $this->set_href($this->_configuration->href);
        }
    }

    /**
     * Returns the current link title.
     *
     * @return  string  The link title value.
     */
    public function get_title()
    {
        // Return the title value
        return $this->_title;
    }

    /**
     * Sets the link title to the passed value.
     *
     * @param   string  The link title to assign.
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
     * Returns the current href value.
     *
     * @return  string  The href value.
     */
    public function get_href()
    {
        // Return the href value
        return $this->_href;
    }

    /**
     * Sets the href value to the passed value.
     *
     * @param   string  The href value to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_href($href)
    {
        // Set the href value
        $this->_href = $href;

        // Return a reference to this class instance
        return $this;
    }

} // End Kohana_UI_Link
