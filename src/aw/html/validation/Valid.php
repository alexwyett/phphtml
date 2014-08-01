<?php

/**
 * Validation rules for form form fields
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
 * Validation rules for form form fields
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
class Valid
{
    /**
     * Required boolean
     * 
     * @var boolean
     */
    protected $required = false;

    /**
     * Value to test
     * 
     * @var mixed
     */
    protected $value;
    
    // ------------------------ Constructor --------------------------------- //

    /**
     * Factory method
     * 
     * @param mixed   $value    Testing value
     * @param boolean $required Required bool
     * 
     * @return \aw\html\validation\Valid
     */
    public static function factory($value, $required = false)
    {
        $class = self::getType();
        $rule = new $class();
        $rule->setValue($value)
            ->setRequired($required);
        return $rule;
    }

    
    /**
     * Get the class name from the instantitated class
     * 
     * @return string
     */
    public static function getType()
    {
        return get_called_class();
    }
    
    // ------------------------ Accessor functions -------------------------- //
    
    /**
     * Return the test value
     * 
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Required boolean check
     * 
     * @return boolean
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * Set the test value
     * 
     * @param mixed $value Value to test
     * 
     * @return \aw\html\validation\Valid
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Toogle the required flag
     * 
     * @param boolean $required Required boolean
     * 
     * @return \aw\html\validation\Valid
     */
    public function setRequired($required)
    {
        $this->required = $required;
        return $this;
    }
    
    // ------------------------ Validation functions ------------------------ //

    /**
     * Validation method
     * 
     * @return boolean
     */
    public function validate()
    {
        $methods = array_reverse(
            array_filter(
                get_class_methods($this),
                function($method) {
                    return (
                        (substr($method, 0, 8) ==  'validate')
                        && ($method != 'validate')
                    );
                }
            )
        );
            
        foreach ($methods as $method) {
            // Method will throw an exception on failure
            $this->$method();
        }
		
        return true;
    }
    
    /**
     * Validation function at the base level
     * 
     * @return boolean
     */
    public function validateNull()
    {
        if (is_null($this->getValue())) {
            throw new ValidationException(
                'Required', 
                1000
            );
        }
    }
}