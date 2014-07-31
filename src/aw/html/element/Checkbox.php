<?php

/**
 * Checkbox object
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

namespace aw\html\element;

/**
 * Checkbox object
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
class Checkbox extends Input
{
    /**
     * Checked state
     * 
     * @var boolean
     */
    protected $checked = false;
    
    /**
     * Constructor
     * 
     * @param string $name       Field name
     * @param array  $attributes Field attributes
     * @param string $type       Field type (defaulted to text)
     * 
     * @return void
     */
    public function __construct($name, $attributes = array(), $type = 'checkbox')
    {
        // Add attributes
        parent::__construct($name, $attributes, $type);
    }
    
    /**
     * Set the new checked state
     * 
     * @param boolean $checked Checked state
     * 
     * @return void
     */
    public function setChecked($checked)
    {
        if (is_bool($checked)) {
            $this->checked = $checked;
            
            if ($this->getRule()) {
                $this->getRule()->setValue($checked);
            }
        }
        return $this;
    }
    
    /**
     * Return the checked state
     * 
     * @return boolean
     */
    public function isChecked()
    {
        return $this->checked;
    }
    
    /**
     * Return attributes string, overriden from textfield to include 
     * the checked state. 
     * 
     * @return string
     */
    public function implodeAttributes()
    {
        $attrs = parent::implodeAttributes();
        
        if ($this->isChecked()) {
            $attrs .= ' checked';
        }
        
        return $attrs;
    }
}