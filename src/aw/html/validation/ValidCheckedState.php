<?php

/**
 * Validation rules for checkboxes/radio buttons in form fields
 *
 * PHP Version 5.4
 *
 * @category  PHPHtml
 * @package   AW
 * @author    Alex Wyett <alex@wyett.co.uk>
 * @copyright 2014 Alex Wyett
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.github.com/alexwyett
 */

namespace aw\html\validation;

/**
 * Validation rules for checkboxes/radio buttons in form fields
 *
 * PHP Version 5.4
 *
 * @category  PHPHtml
 * @package   AW
 * @author    Alex Wyett <alex@wyett.co.uk>
 * @copyright 2014 Alex Wyett
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.github.com/alexwyett
 */
class ValidCheckedState extends Valid
{
    /**
     * Factory method
     * 
     * @param mixed   $value    Testing value
     * @param boolean $required Required bool
     * 
     * @return \aw\html\validation\ValidCheckedState
     */
    public static function factory($value, $required = false)
    {
        $rule = parent::factory($value, $required);
        return $rule->setValue(false);
    }
    
    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        $this->setValue(false);
    }

    // ------------------------ Validation functions ------------------------ //

    /**
     * Checked State function
     * 
     * @return boolean
     */
    public function validateChecked()
    {
        if ($this->getValue() === false) {
            throw new ValidationException(
                'Required',
                1003
            );
        }
    }
}