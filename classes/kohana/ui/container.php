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

} // End Kohana_UI_Container
