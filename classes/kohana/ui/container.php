<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Base class for all of the container classes. Containers are components
 * that are able to hold child components.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Container extends UI_Component {

    /**
     * @var  string  Holds any HTML content that was manually added.
     */
    protected $_html = '';

    /**
     * @var  array  Holds child components.
     */
    protected $_items = array();

    /**
     * Sets up the specific configuration items on this class instance.
     *
     * @return  null
     */
    protected function _initialize()
    {
        // Call the parent initialize method
        parent::_initialize();

        // If the configuration data has an html property
        if (isset($this->_configuration->html)) {
            // Set the html property
            $this->set_html($this->_configuration->html);
        }
    }

    /**
     * Attempts to add the passed class instance or generate string
     * as a child component.
     *
     * @param   mixed   If an instance of UI_Component is passed, we simply
     *                  add it to the '_items' array on this object. If
     *                  anything else is passed in, we forward the passed data
     *                  to the 'UI::generate' method and then attempt to add
     *                  the return value to the '_items' array.
     * @return  object  A reference to this class instance.
     */
    public function add($child)
    {
        // If the child is an instance of UI_Component
        if ($child instanceof UI_Component) {
            // Add it to the '_items' array
            $this->_items[] = $child;

            // Return a reference to this class instance
            return $this;
        }

        // If the passed child data is an object or an array
        if (is_object($child) OR is_array($child)) {
            // Attempt to add the result of the call to 'UI::generate'
            $this->add(UI::generate($child));

            // Return a reference to this class instance
            return $this;
        }

        // If we made it down here, we did not know what to do, so we will
        // just throw an exception
        throw new UI_Exception('Unable to add child item.');
    }

    /**
     * Attempts to find any matching containers or components in this tree
     * using the provided query string.
     *
     * @param   mixed  The query string, or an array of query objects.
     * @return  array  All of the matching class instances.
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

        // Determine if this class instance matches the query, and if so, add
        // this class instance to the initial set of matches
        $matches = parent::query($queries)->matches();

        // Loop over each of the child items
        foreach ($this->_items as $item) {
            // Merge any returned matches with the current set of matches
            $matches = array_merge($matches,
                $item->query($queries)->matches());
        }

        // Return all of the matches
        return new UI_Query_Result($matches);
    }

    /**
     * Executes the query method searching for a specific child with an id
     * value that matches the passed name string.
     *
     * @param   string  The name of the object we are searching for.
     * @return  object  The first object returned by the query.
     */
    public function __get($name)
    {
        // Execute the query and get the result
        $result = $this->query('#'.$name);

        // If we had no matches
        if ($result->count() < 1) {
            // Throw an exception
            throw new Kohana_UI_Exception('Could not find a child object '.
                'with an id value of ":id".', array(':id' => $name));
        }

        // Return a reference to the first matching child object
        return $result->shift();
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
        $view->container = $this;

        // Render the view and return the result
        return $view->render();
    }

    /**
     * Renders the HTML for each of the child items.
     *
     * @return  string  The rendered HTML content.
     */
    public function render_children()
    {
        // Initialize the HTML output buffer to include any
        // direct HTML content configured on this class
        $html = $this->get_html();

        // Loop over each of the child items
        foreach ($this->_items as $item) {
            // Render the HTML for the current child item
            $html .= $item->render();
        }

        // Return all of the HTML generated by the child items
        return $html;
    }

    /**
     * Returns the current html content.
     *
     * @return  string  The html content value.
     */
    public function get_html()
    {
        // Return the html value
        return $this->_html;
    }

    /**
     * Sets the html content to the passed value.
     *
     * @param   string  The html content to assign.
     * @return  object  A reference to this class instance.
     */
    public function set_html($html)
    {
        // Set the html value
        $this->_html = $html;

        // Return a reference to this class instance
        return $this;
    }

} // End Kohana_UI_Container
