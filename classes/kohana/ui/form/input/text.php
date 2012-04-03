<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Manages a single text input field.
 *
 * @package    Kohana/UI
 * @category   Extension
 * @author     Kohana Team
 * @copyright  (c) 2011-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_UI_Form_Input_Text extends UI_Form_Input {}

// Register this type as a form input
UI_Form::register_input_type('form-input-text');
