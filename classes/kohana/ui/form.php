<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Handles the rendering and data management tasks for a form.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Form extends UI_Container {

    /**
     * @var  array  Holds all of the known form input types.
     */
    protected static $_input_types = array();

    /**
     * Registers the passed type name as a form input type.
     *
     * @param   string  The type name to register.
     * @return  null
     */
    public static function register_input_type($type)
    {
        self::$_input_types[$type] = TRUE;
    }

    /**
     * Returns all of the known input types as an array.
     *
     * @return  array  An array of input types.
     */
    protected static function _get_input_types()
    {
        // Return the known types
        return array_keys(self::$_input_types);
    }

    /**
     * @var  string  Holds the form action value.
     */
    protected $_action = NULL;

    /**
     * @var  string  Holds the form method value.
     */
    protected $_method = 'POST';

    /**
     * Sets up the specific configuration items on this class instance.
     *
     * @return  null
     */
    protected function _initialize()
    {
        // Call the parent initialize method
        parent::_initialize();

        // If the configuration data has an action property
        if (isset($this->_configuration->action)) {
            // Set the action
            $this->set_action($this->_configuration->action);
        }

        // If the configuration data has a method property
        if (isset($this->_configuration->method)) {
            // Set the method property
            $this->set_method($this->_configuration->method);
        }
    }

    /**
     * Returns the current action.
     *
     * @return  string  The action value.
     */
    public function get_action()
    {
        // Return the action value
        return $this->_action;
    }

    /**
     * Sets the action to the passed value.
     *
     * @param   string  The action to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_action($action)
    {
        // Set the action value
        $this->_action = $action;

        // Return a reference to this class instance
        return $this;
    }

    /**
     * Returns the current method.
     *
     * @return  string  The method value.
     */
    public function get_method()
    {
        // Return the method value
        return $this->_method;
    }

    /**
     * Sets the method to the passed value.
     *
     * @param   string  The method to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_method($method)
    {
        // Set the method value
        $this->_method = $method;

        // Return a reference to this class instance
        return $this;
    }

    /**
     * Attempts to load the passed form data. If nothing is passed in, this
     * method attempts to load the form data from the $_POST superglobal.
     *
     * @param   mixed   Optional. An array or object of key/value pairs to
     *                  load. If nothing was provided, this method will use
     *                  the data in the $_POST superglobal.
     * @return  object  A reference to this class instance.
     */
    public function load($data = NULL)
    {
        // If no data was passed in, use the $_POST superglobal
        $data = isset($data) ? $data : $_POST;

        // Cast the data into an array so that we know what syntax to use, and
        // convert all of the passed keys to lowercase
        $data = array_change_key_case((array) $data);

        // Grab the list of known form types
        $types = self::_get_input_types();

        // Grab all of the child form types and query for them
        $objects = $this->query(implode(', ', $types));

        // Loop over each of the child form objects
        foreach ($objects->matches() as $object) {
            // If we somehow matched an object that was not a form input
            if ( ! ($object instanceof UI_Form_Input)) {
                // Move on to the next object and ignore this one
                continue;
            }

            // Attempt to load the data into the current form input object
            $object->load($data);
        }
    }

    /**
     * Attempts to determine if this form was posted using the hidden form
     * field named '_form_id'. This, of course, only works if a unique id was
     * provided for this form. If no data is passed in, this method attempts
     * to use the $_POST superglobal.
     *
     * @param   mixed    Optional. An array or object of key/value pairs to
     *                   load. If nothing was provided, this method will use
     *                   the data in the $_POST superglobal.
     * @return  boolean  If this form was posted or not.
     */
    public function posted($data = NULL)
    {
        // Grab the id value of this class instance
        $id = $this->get_id();

        // If no id has been assigned to this form
        if ( ! isset($id)) {
            // Throw an exception
            throw new Kohana_UI_Exception('This method requires a '.
                'unique id to be assigned to this form.');
        }

        // If no data was passed in, use the $_POST superglobal
        $data = isset($data) ? $data : $_POST;

        // Cast the data into an array so that we know what syntax to
        // use, and convert all of the passed keys to lowercase
        $data = array_change_key_case((array) $data);

        // If '_form_id' is not defined
        if ( ! isset($data['_form_id'])) {
            // This couldn't be the right form
            return FALSE;
        }

        // If the form id in the data does not match the id
        // value assigned to this form
        if ($id !== $data['_form_id']) {
            // This is not the right form
            return FALSE;
        }

        // If we made it down here, that means this form was posted
        return TRUE;
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

        // Add the action attribute
        $attributes['action'] = (string) $this->get_action();

        // Add the method attribute
        $attributes['method'] = (string) $this->get_method();

        // Return the completed set of attributes
        return $attributes;
    }

} // End Kohana_UI_Form
