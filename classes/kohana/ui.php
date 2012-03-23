<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Base class with utility and library management methods.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI {

    /**
     * Generates a UI class structure using the passed object/array structure.
     *
     * @param   mixed  A nested structure of UI definitions.
     * @return  mixed  An object structure of nested UI classes.
     */
    public static function generate($structure,
        $serialized_deserialized = FALSE)
    {
        // If we have not already encoded and decoded this structure
        if ( ! $serialized_deserialized) {
            // Convert the passed structure into a string of JSON, then back
            // again into real PHP types. This will cast key/value pair arrays
            // into objects, and ordered arrays will remain arrays. We only
            // have do do this once.
            $structure = json_decode(json_encode($structure));
        }

        // If we do not have a '_type' property
        if ( ! isset($structure->_type)) {
            // Throw an exception
            throw new UI_Exception('Passed structure does not have a '.
                '"_type" property.');
        }

        // Grab a shortcut reference to the '_type' property
        $type = $structure->_type;

        // Determine what the class name should be
        $class_name = 'UI_'.str_replace('-', '_', $type);

        // If we do not have a class with this name
        if ( ! class_exists($class_name)) {
            // Throw an exception
            throw new UI_Exception('UI class not found for type ":type".',
                array(':type' => $type));
        }

        // Return a new instance of the UI class, passing the structure
        $object = new $class_name($structure);

        // If the object does not support children or we do not have an
        // '_items' property on the current structure
        if ( ! $object instanceof UI_Container OR
            ! isset($structure->_items)) {
            // Just return the object with no further processing
            return $object;
        }

        // Loop over the items collection and add the child items
        foreach ($structure->_items as $item) {
            // Attempt to add this child item
            $object->add(self::generate($item, TRUE));
        }

        // Return the finished object
        return $object;
    }

} // End Kohana_UI
