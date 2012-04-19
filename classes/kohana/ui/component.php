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
     * @var  string  Holds the type name of this component.
     */
    protected $_type_name = NULL;

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
     * @param  object  Optional. An object or array with key/value pairs
     *                 to configure this class instance. Defaults to NULL.
     */
    public function __construct($configuration = NULL)
    {
        // Store the passed configuration data cast to an object
        $this->_configuration = (object) (isset($configuration) ?
            $configuration : array());

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

        // If the type name has not already been defined
        if ( ! isset($this->_type_name)) {
            // Determine the type name using the class name. For example, if
            // the class name is 'UI_Super_Duper_Hyperlink', this next line of
            // code will make the type name be 'super-duper-hyperlink'.
            $this->_type_name = str_replace('_', '-', strtolower(substr(
                get_class($this), 3)));
        }

        // If we have an id assigned in the passed configuration data
        if (isset($this->_configuration->id)) {
            // Set the ID value
            $this->set_id($this->_configuration->id);
        }

        // If we have a class string in the passed configuration data
        if (isset($this->_configuration->class)) {
            // Set the class
            $this->set_class($this->_configuration->class);
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
     * Sets all of the class values on this component, replacing any that
     * are already defined.
     *
     * @param   string  The class, or classes, to add.
     * @return  object  A reference to this class instance.
     */
    public function set_class($class_string)
    {
        // Destroy all of the current classes
        $this->_classes = array();

        // Break apart the passed class string on the space character
        $classes = explode(' ', $class_string);

        // Loop over each of the classes
        foreach ($classes as $class) {
            // Add the passed class name
            $this->add_class($class);
        }

        // Return a reference to this class instance
        return $this;
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
     * Returns the HTML attributes to assign to this component.
     *
     * @return  array  An array of key/value pairs.
     */
    public function get_attributes()
    {
        // Initialize the attributes array
        $attributes = array();

        // Grab the id value and cast it to a string
        $id = (string) $this->get_id();

        // If we have an id value
        if ($id !== '') {
            // Add the id attribute
            $attributes['id'] = $id;
        }

        // Grab any classes that have been defined
        $classes = implode(' ', $this->get_classes());

        // If we have any classes
        if ($classes !== '') {
            // Put the classes in an attribute
            $attributes['class'] = $classes;
        }

        // Return the completed set of attributes
        return $attributes;
    }

    /**
     * Checks to see if this class instance matches the passed query string.
     *
     * @param   mixed  The query string, or an array of query objects.
     * @return  array  An empty array, if this class instance doesnt match,
     *                 or an array with a reference to this class instance.
     */
    public function query($queries)
    {
        // If a query string was passed
        if (is_string($queries)) {
            // Parse the query string and grab a query object
            $queries = UI_Query::factory($queries);
        }

        // If we have no queries to run
        if (empty($queries)) {
            // Return an empty query result
            return new UI_Query_Result(array());
        }

        // Loop over each of the queries
        foreach ($queries as $query) {
            // Return the type name value
            $type_name = $query->get_type_name();

            // If we are searching for a specific type name, and our type
            // name does not match the type name we are searching for
            if (isset($type_name) AND
                $this->_type_name !== strtolower($type_name)) {
                // Move on to the next query
                continue;
            }

            // Return the query id value
            $query_id = $query->get_id();

            // If we are searching for a specific id, and our id does not
            // match the id we are searching for
            if (isset($query_id) AND
                strtolower($this->_id) !== strtolower($query_id)) {
                // Move on to the next query
                continue;
            }

            // Grab the class names to search for
            $classes = $query->get_classes();

            // Loop over each of the class names
            foreach ($classes as $class) {
                // If we do not have this class name assigned
                if ( ! isset($this->_classes[$class])) {
                    // Move on to the next query
                    continue 2;
                }
            }

            // Grab the attributes to search for
            $attributes = $query->get_attributes();

            // Loop over each of the attribute key/value pairs
            foreach ($attributes as $key => $value) {
                // If we do not have this property on this class
                if ( ! property_exists($this, '_'.$key)) {
                    // Move on to the next query
                    continue 2;
                }

                // If the property value does not match
                if ((string) $this->{'_'.$key} !== (string) $value) {
                    // Move on to the next query
                    continue 2;
                }
            }

            // If we made it to here, we must have a match
            return new UI_Query_Result(array($this));
        }

        // If we made it to here, we matched nothing
        return new UI_Query_Result(array());
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
