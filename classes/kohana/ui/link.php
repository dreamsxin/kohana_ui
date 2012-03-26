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
     * @var  string  Holds the link text.
     */
    protected $_text = NULL;

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

        // If we have a text value in the passed configuration
        if (isset($this->_configuration->text)) {
            // Set the text value
            $this->set_text($this->_configuration->text);
        }
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
     * Returns the current link text.
     *
     * @return  string  The link text value.
     */
    public function get_text()
    {
        // Return the text value
        return $this->_text;
    }

    /**
     * Sets the link text to the passed value.
     *
     * @param   string  The link text to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_text($text)
    {
        // Set the text value
        $this->_text = $text;

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

        // Grab the href value and cast it to a string
        $href = (string) $this->get_href();

        // Add the href attribute
        $attributes['href'] = $href !== '' ? $href : '#';

        // Attempt to grab the link title
        $title = (string) $this->get_title();

        // If we have a title
        if ($title !== '') {
            // Add a title attribute
            $attributes['title'] = $title;
        }

        // Return the completed set of attributes
        return $attributes;
    }

} // End Kohana_UI_Link
