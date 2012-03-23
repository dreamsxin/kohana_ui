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
class Kohana_UI_HTML_Document extends UI_Container {

    /**
     * @var  array  An array of all of the JavaScript resources to load
     *              in the head section of the document.
     */
    protected $_javascript = array();

    /**
     * @var  array  An array of all of the CSS resources we would like to
     *              load in the head section of the document.
     */
    protected $_css = array();

    /**
     * @var  string  Holds the page title.
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

        // Copy the page title from the configuration data
        $this->set_title(isset($this->configuration->title) ?
            $this->configuration->title : '');
    }

} // End Kohana_UI_HTML_Document
