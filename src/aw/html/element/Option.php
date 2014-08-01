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
class Option extends \aw\html\base\TextElement
{
    /**
     * Checked state
     * 
     * @var boolean
     */
    protected $selected = false;
    
    /**
     * Constructor
     * 
     * @param string $text       Field text
     * @param array  $attributes Field attributes
     * 
     * @return void
     */
    public function __construct($text, $attributes = array())
    {
        // Add attributes
        parent::__construct($text, $attributes);
        
        $this->setTemplate(
            '<{getType}{implodeAttributes}>{getText}</{getType}>');
    }
    
    /**
     * Get the value of the option
     * 
     * @return string
     */
    public function getValue()
    {
        if (array_key_exists('value', $this->attributes)) {
            return $this->getAttribute('value');
        }
        
        return '';
    }
    
    /**
     * Set the selected state
     * 
     * @param boolean $selected Selected bool
     * 
     * @return \aw\html\element\Option
     */
    public function setSelected($selected)
    {
        $this->selected = $selected;

        return $this;
    }
    
    /**
     * Return the selected state
     * 
     * @return boolean
     */
    public function isSelected()
    {
        return $this->selected;
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
        
        if ($this->isSelected()) {
            $attrs .= ' selected';
        }
        
        return $attrs;
    }
}