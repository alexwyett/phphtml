<?php

/**
 * Base element
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

namespace aw\html\base;

/**
 * Element object
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
abstract class FormElement extends Element
{
    /**
     * Validation rule applied
     * 
     * @var \aw\html\validation\Valid
     */
    protected $rule = null;

    // ------------------------- Public Methods ----------------------------- //

    
    
    // ------------------------- Accessor Methods -------------------------- //
    
    /**
     * Set validity status
     *
     * @param string|object $rule     Name of validation rule to use.  You may use 
     * a validation object here if you want to set additional variables
     * in a validation object prior to validating the field.
     * @param boolean       $required Required flag for rule
     * 
     * @return \aw\html\core\FormElement
     */
    public function setRule($rule, $required = false)
    {
        if (is_object($rule)) {
            $this->rule = $rule;
        } else {
            $rule = "\aw\\html\\validation\\{$rule}";
            $this->rule = $rule::factory($this->getValue());
        }
        
        // Set the required status of the rule
        $this->rule->setRequired($required);
        
        return $this;
    }
    
    // ------------------------ Validation functions ------------------------ //

    /**
     * Return true if validation can applied to this element
     * 
     * @return boolean
     */
    public function isTestable()
    {
        return is_object($this->getRule());
    }
    
    /**
     * Test required status
     *
     * @return boolean
     */
    public function isRequired()
    {
        if ($this->isTestable()) {
            return $this->getRule()->isRequired();
        } else {
            return false;
        }
    }
    
    // -------------------------- Private Methods -------------------------- //
    
    
}