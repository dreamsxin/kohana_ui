<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Base class for all of the component classes.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Component {

    /**
     * @var  string  Holds the view name this component will attempt to use
     *               to render its HTML content.
     */
    protected $_view_name = NULL;

    /**
     * @var  array  Holds a reference to the configuration data used to
     *              set up this class instance.
     */
    protected $_configuration = array();

    /**
     * Configures a new instance of this class using the passed
     * configuration data using the _initialize method.
     *
     * @param  object  An object with key/value pairs to configure this
     *                 class instance.
     */
    public function __construct($configuration)
    {
        // Store the passed configuration data
        $this->_configuration = $configuration;

        // Initialize this class
        $this->_initialize();
    }

    /**
     * Configures a new instance of this class using the passed
     * configuration data.
     *
     * @param  object  An object with key/value pairs to configure this
     *                 class instance.
     */
    protected function _initialize()
    {
        // If the view name has not already been defined
        if ( ! isset($this->_view_name)) {
            // Determine the view name using the class name. For example, if
            // the class name is 'UI_Super_Duper_Hyperlink', this next line of
            // code will make the view name be 'ui/super/duper/hyperlink'.
            $this->_view_name = str_replace('_', '/', strtolower(get_class(
                $this)));
        }
    }

    /**
     * Renders this object using the corresponding view file.
     *
     * @return  string  The rendered HTML content.
     */
    public function render()
    {
        // Create a new instance of the view class for this component
        $view = View::factory($this->_view_name);

        // Add a reference to this class instance to the view
        $view->component = $this;

        // Attempt to render the view
        return View::render();
    }

    /**
     * Attempting to use this object in a string context will automatically
     * execute the render method.
     *
     * @return  string  The rendered HTML content.
     */
    public function __toString()
    {
        // Return the result of the render method
        return $this->render();
    }

} // End Kohana_UI_Component
