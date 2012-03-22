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
     * @var  string  Holds the unique ID of this component, if one has
     *               been assigned.
     */
    protected $_id = NULL;

    /**
     * @var  array  Holds any class names that we want to assign to
     *              this component.
     */
    protected $_classes = array();

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

        // If we have an id assigned in the passed configuration data
        if (isset($this->configuration->id)) {
            // Set the ID value
            $this->_id = $this->configuration->id;
        }
    }

    /**
     * Sets the ID value on this component.
     *
     * @param   string  The ID value to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_id($id)
    {
        // Set the ID value
        $this->_id = $id;

        // Return a reference to this class instance
        return $this;
    }

    /**
     * Returns the configured ID value.
     *
     * @return  mixed  The ID value for this component, if one is defined.
     */
    public function get_id()
    {
        // Return the configured ID value
        return $this->_id;
    }

    /**
     * Attempts to add the passed class to this component.
     *
     * @param   string  The class name to add.
     * @return  object  A reference to this class instance.
     */
    public function add_class($class)
    {
        // Add the passed class name
        $this->_classes[$class] = TRUE;

        // Return a reference to this class instance
        return $this;
    }

    /**
     * Remove the class using the passed class name.
     *
     * @param   string  The class name to remove.
     * @return  object  A reference to this class instance.
     */
    public function remove_class($class)
    {
        // Delete the passed class name
        unset($this->_classes[$class]);

        // Return a reference to this class instance
        return $this;
    }

    /**
     * Returns the classes configured for this component.
     *
     * @return  array  An array of class names.
     */
    public function get_classes()
    {
        // Return the configured class names
        return array_keys($this->_classes);
    }

    /**
     * Checks to see if this class instance matches the passed query string.
     *
     * @param   string  The query string to search for.
     * @return  array   An empty array, if this class instance doesnt match,
     *                  or an array with a reference to this class instance.
     */
    public function query($query)
    {
        // If a query string was passed
        if (is_string($query)) {
            // Parse the query string and tranform it into a query object
            $query = $this->_parse_query_string($query);
        }

        // If we were unable to parse the query string
        if ( ! isset($query)) {
            // Return an empty array
            return array();
        }

        // If we are searching for a specific id, but the lowercase version of
        // our local id does not match the id we are looking for
        if (isset($query->id) AND strtolower($this->_id) !== strtolower($query->id)) {
            // Return an empty array
            return array();
        }

        // If we made it down here, we must have matched because we managed to pass
        // through all of the disqualification checks
        return array($this);
    }

    /**
     * Attempts to parse the passed query string into a query object.
     *
     * @param   string  The query string to parse.
     * @return  object  A query object with the details of what we are
     *                  searching for.
     */
    protected function _parse_query_string($query)
    {
        // Trim the query string
        $query = trim($query);

        // If we are searching for a specific id
        if (substr($query, 0, 1) === '#') {
            // Grab the id value from the query string, and make it lowercase
            $query_id = strtolower(substr($query, 1));
        }

        // If we have no search criteria
        if ( ! isset($query_id)) {
            // Return NULL
            return NULL;
        }

        // Return the finished query object
        return (object) array(
            'id' => isset($query_id) ? $query_id : NULL,
        );
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

        // Render the view and return the result
        return $view->render();
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
