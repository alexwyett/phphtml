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
abstract class FormElement extends ChildElement
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
	 * Return the rule
	 *
	 * @return \aw\html\validation\Valid
	 */
	public function getRule()
	{
		return $this->rule;
	}
	
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
    
    /**
     * Set the Value
     * 
     * @param string $value Element Value
     * 
     * @return \aw\html\core\FormElement
     */
    public function setValue($value)
    {
        $this->value = $value;

        // Set attribute value
        $this->attributes['value'] = $this->getValue();

        // Set value to validation rule if present
        if ($this->getRule()) {
            $this->getRule()->setValue($this->getValue());
        }

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