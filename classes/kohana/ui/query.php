<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Handles query string parsing and returning information about the query.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Query {

    /**
     * @const  string  Holds the set of characters we think could be part of a
     *                 valid chunk of query string data.
     */
    const CHUNK_CHARACTERS = 'abcdefghijklmnopqrstuvwxyz0123456789-_';

    /**
     * @var  array  Holds the ID being searched for, if any.
     */
    protected $_id = NULL;

    /**
     * @var  array  Holds the set of classes we are searching for, if any.
     */
    protected $_classes = array();

    /**
     * Returns an array of new query objects using the passed query string.
     *
     * @param   string  The query string to parse.
     * @return  array   An array of query objects.
     */
    public function factory($query)
    {
        // Create an empty array to put the finished query objects in
        $query_objects = array();

        // Break apart any separate queries that may be defined
        $query_strings = explode(' ', $query);

        // Loop over the separate query strings
        foreach ($query_strings as $query_string) {
            // Attempt to create a new query object and add it to the
            // query objects array
            $query_objects[] = new UI_Query($query_string);
        }

        // Return all of the query objects we created
        return $query_objects;
    }

    /**
     * Attempts to configure this class instance using the passed
     * query string.
     *
     * @param  string  The query string to parse.
     */
    protected function __construct($input)
    {
        // Trim the input string
        $input = trim($input);

        // Grab the length of the passed input string
        $input_length = strlen($input);

        // Initialize the current character index
        $index = 0;

        // Loop over each character in the query string
        while ($index < $input_length) {
            // Grab a reference to the current character
            $character = $input[$index];

            // If we think we have found the start of an id
            if ($character === '#') {
                // Increment the index
                $index++;

                // Set the id to the next chunk of data
                $this->_id = $this->_get_chunk($index, $input);
            // If we think we have found the start of a class name
            } elseif ($character === '.') {
                // Increment the index
                $index++;

                // Add the next chunk of data to the classes array
                $this->_classes[$this->_get_chunk($index, $input)] = TRUE;
            }
        }
    }

    /**
     * Returns the ID that we are searching for.
     *
     * @return  mixed  The ID string to search for, if we have one. If we are
     *                 not searching for an ID, this method will return NULL.
     */
    public function get_id()
    {
        // Return the ID string
        return $this->_id;
    }

    /**
     * Return the class names we are searching for.
     *
     * @return  array  An array of class names we are searching for.
     */
    public function get_classes()
    {
        // Return the classes we are searching for
        return array_keys($this->_classes);
    }

    /**
     * Returns the next chunk of characters from the passed input string.
     *
     * @param   int     The current position in the input string.
     * @param   string  The whole input string.
     * @return  string  The next chunk of characters.
     */
    protected function _get_chunk(& $index, $input)
    {
        // Create the output buffer
        $output = '';

        // Determine the length of the input string
        $input_length = strlen($input);

        // Loop over the input data character by character
        while ($index < $input_length) {
            // Grab a reference to the current character
            $character = $input[$index];

            // If the current character is not a valid name character
            if ( ! $this->_chunk_character($character)) {
                // Break out of the while loop
                break;
            }

            // Add this character to the output buffer
            $output .= $character;

            // Increment the current character position
            $index++;
        }

        // Return the output buffer
        return $output;
    }

    /**
     * Returns whether or not we think the current character could be part of
     * the next 'chunk'. Like a class name, or an attribute name.
     *
     * @param   string   The character to evaluate.
     * @return  boolean  If we think it should be part of the chunk.
     */
    protected function _chunk_character($input)
    {
        // If the passed character is in the list of valid chunk
        // characters, return boolean TRUE
        return strpos(self::CHUNK_CHARACTERS, $input) !== FALSE;
    }

} // End Kohana_UI_Query
