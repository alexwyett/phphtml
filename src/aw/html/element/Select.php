<?php

/**
 * Select element
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
 * Select element
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
class Select extends \aw\html\base\FormElement
{
    /**
     * Factory method for creating a select box
     * 
     * @param string $name        Name of element
     * @param array  $values      Values of the select box in key/val pair
     * @param array  $attributes  Element attributes
     * @param string $selectedVal Value of selected element
     * 
     * @return \aw\html\element\Select
     */
    public static function factory(
        $name, 
        $values = array(),
        $attributes = array(), 
        $selectedVal = null
    ) {
        $select = new Select($name, $attributes);
        foreach ($values as $key => $val) {
            // Support for the optgroup object
            if (is_object($val)) {
                $select->addChild($val);
            } else if (is_array($val)) {
                $select->addChild(
                    new Option($key, $val)
                );
            } else {
                $select->addChild(
                    new Option(
                        $key,
                        array('value' => $val)
                    )
                );
            }
        }
        
        $select->setValue($selectedVal);

        return $select;
    }
    
    // -------------------------- Public Methods --------------------------- //
        
    /**
     * Constructor
     * 
     * @param string $name       Select field name
     * @param array  $attributes Field attributes
     * 
     * @return \aw\html\element\Select
     */
    public function __construct($name, $attributes = array())
    {
        parent::__construct($attributes);

        // Set element name
        $this->setName($name);

        // Default template
        $this->setTemplate(
            '<{getType}{implodeAttributes}>{renderChildren}</{getType}>'
        );
    }
    
    // ------------------------- Accessor Methods -------------------------- //

    /**
     * Override the get value func from textfield.
     * Selects should have no value
     * 
     * @return string
     */
    public function getValue()
    {
        $selected = $this->getSelected();
        if ($selected) {
            return $selected->getValue();
        } else {
            return '';
        }
    }

    /**
     * Get the selected option
     * 
     * @return string
     */
    public function getSelected()
    {
        foreach ($this->getChildren() as $child) {
            if ($child->isSelected()) {
                return $child;
            }
        }
        return;
    }
    
    /**
     * Accessory method for setting the selected element of the select field
     * 
     * @param string $value Value to be selected
     * 
     * @return \aw\html\element\Select
     */
    public function setValue($value)
    {
        foreach ($this->getElementsBy('getType', 'option') as $ele) {
            $ele->setSelected(false);
            if ($ele->getValue() == $value) {
                $ele->setSelected(true);

                // Set value to validation rule if present
                if ($this->getRule()) {
                    $this->getRule()->setValue($value);
                }
            }
        }
        return $this;
    }
}