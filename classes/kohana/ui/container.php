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
     * @var  array  Holds child components.
     */
    protected $_items = array();

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

        // If the passed child data is an object
        if (is_object($child)) {
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
     * @param   mixed  The query string, or query object to search for.
     * @return  array  All of the matching class instances.
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

        // Determine if this class instance matches the query, and if so, add
        // this class instance to the initial set of matches
        $matches = parent::query($query);

        // Loop over each of the child items
        foreach ($this->_items as $item) {
            // Merge any returned matches with the current set of matches
            $matches = array_merge($matches, $item->query($query));
        }

        // Return all of the matched class instances
        return $matches;
    }

} // End Kohana_UI_Container
