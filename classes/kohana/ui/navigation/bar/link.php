<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Handles the rendering of a single link in the navigation bar.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Navigation_Bar_Link extends UI_Link {

    /**
     * Returns TRUE if we think this link should be marked as
     * being the "active" link.
     *
     * @return  boolean  If we should be marked as active.
     */
    public function get_active()
    {
        // Grab the href value assigned to this link
        $href = $this->get_href();

        // Grab the URI of the current request
        $uri = Request::current()->uri();

        // If the current URI does not start with the href
        // value of this link
        if (substr($uri, 0, strlen($href)) !== $href) {
            // This link should not be active
            return FALSE;
        }

        // This link should be active
        return TRUE;
    }

} // End Kohana_UI_Navigation_Bar_Link
