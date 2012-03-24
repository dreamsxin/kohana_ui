<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Handles the rendering of the top-level container.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Document extends UI_Container {

    /**
     * @var  string  Holds the page title.
     */
    protected $_title = NULL;

    /**
     * @var  array  An array of all of the CSS resources we would like to
     *              load in the head section of the document.
     */
    protected $_css = array();

    /**
     * @var  array  An array of all of the JavaScript resources to load
     *              in the head section of the document.
     */
    protected $_javascript = array();

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
            // Set the page title
            $this->set_title($this->_configuration->title);
        }

        // If the configuration data has a css property
        if (isset($this->_configuration->css)) {
            // Set the CSS property
            $this->set_css($this->_configuration->css);
        }

        // If the configuration data has a javascript property
        if (isset($this->_configuration->javascript)) {
            // Set the JavaScript property
            $this->set_javascript($this->_configuration->javascript);
        }
    }

    /**
     * Returns the current page title.
     *
     * @return  string  The page title value.
     */
    public function get_title()
    {
        // Return the title value
        return $this->_title;
    }

    /**
     * Sets the page title to the passed value.
     *
     * @param   string  The page title to assign.
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
     * Sets one or more passed CSS paths, overwriting whatever was there.
     *
     * @param   mixed   A string with a single CSS URI or an array of them.
     * @return  object  A reference to this class instance.
     */
    public function set_css($uris)
    {
        // Clear out the current CSS values
        $this->_css = array();

        // If the passed value is a string, make it an array with one item
        $uris = is_string($uris) ? array($uris) : $uris;

        // Loop over each of the passed uris
        foreach ($uris as $uri) {
            // Add this CSS URI
            $this->add_css($uri);
        }

        // Return a reference to this class instance
        return $this;
    }

    /**
     * Adds a single CSS path to the css property.
     *
     * @param   string  The CSS URI or URI partial.
     * @return  object  A reference to this class instance.
     */
    public function add_css($uri)
    {
        // Add the passed URI to the css property
        $this->_css[$uri] = TRUE;
    }

    /**
     * Removes a CSS URI from the css property.
     *
     * @param   string  The CSS URI or URI partial.
     * @return  object  A reference to this class instance.
     */
    public function remove_css($uri)
    {
        // Remove the passed URI
        unset($this->_css[$uri]);
    }

    /**
     * Returns an array of CSS URIs.
     *
     * @return  array  An array with CSS URIs.
     */
    public function get_css()
    {
        // Return all of the CSS URIs in an array
        return array_keys($this->_css);
    }

    /**
     * Sets one or more passed JavaScript URIs, overwriting whatever
     * was there.
     *
     * @param   mixed   A string with a single JavaScript URI, or an array
     *                  with multiple JavaScript URIs.
     * @return  object  A reference to this class instance.
     */
    public function set_javascript($uris)
    {
        // Clear out the current JavaScript values
        $this->_javascript = array();

        // If the passed value is a string, make it an array with one item
        $uris = is_string($uris) ? array($uris) : $uris;

        // Loop over each of the passed uris
        foreach ($uris as $uri) {
            // Add this JavaScript URI
            $this->add_javascript($uri);
        }

        // Return a reference to this class instance
        return $this;
    }

    /**
     * Adds a single JavaScript URI.
     *
     * @param   string  The JavaScript URI or URI partial.
     * @return  object  A reference to this class instance.
     */
    public function add_javascript($uri)
    {
        // Add the passed URI
        $this->_javascript[$uri] = TRUE;
    }

    /**
     * Removes a single JavaScript URI.
     *
     * @param   string  The JavaScript URI or URI partial.
     * @return  object  A reference to this class instance.
     */
    public function remove_javascript($uri)
    {
        // Remove the passed URI
        unset($this->_javascript[$uri]);
    }

    /**
     * Returns an array of JavaScript URIs.
     *
     * @return  array  An array with JavaScript URIs.
     */
    public function get_javascript()
    {
        // Return all of the CSS URIs in an array
        return array_keys($this->_javascript);
    }

} // End Kohana_UI_Document
