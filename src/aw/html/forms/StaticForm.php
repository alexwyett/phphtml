<?php

/**
 * Static form object
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

namespace aw\html\forms;

/**
 * Static form object.  Extends the generic form and provides a static helper
 * method to build the form object
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
class StaticForm extends \aw\html\element\Form
{
    /**
     * Create a new label and checkbox input field
     * 
     * @param string  $label          Label name
     * @param string  $validationRule Name of the validation rule thats required
     * to validate the field
     * @param boolean $required       Set to true if the rule is required or not
     * 
     * @return \aw\html\element\Label
     */
    public static function getNewLabelAndCheckboxField(
        $label,  
        $validationRule = null,
        $required = false
    ) {
        return self::_getNewLabelAndField(
            'Checkbox', 
            $label, 
            $validationRule, 
            $required
        );
    }
    
    /**
     * Create a new label and child text input field
     * 
     * @param string  $label          Label name
     * @param string  $validationRule Name of the validation rule thats required
     * to validate the field
     * @param boolean $required       Set to true if the rule is required or not
     * 
     * @return \aw\html\element\Label
     */
    public static function getNewLabelAndTextField(
        $label,  
        $validationRule = null,
        $required = false
    ) {
        return self::_getNewLabelAndField(
            'Input', 
            $label, 
            $validationRule, 
            $required
        );
    }
    
    /**
     * Create a new label and child textarea field
     * 
     * @param string  $label          Label name
     * @param string  $validationRule Name of the validation rule thats required
     * to validate the field
     * @param boolean $required       Set to true if the rule is required or not
     * 
     * @return \aw\html\element\Label
     */
    public static function getNewLabelAndTextArea(
        $label,  
        $validationRule = null,
        $required = false
    ) {
        return self::_getNewLabelAndField(
            'Textarea', 
            $label, 
            $validationRule, 
            $required
        );
    }
    
    /**
     * Create a new label and select element pair
     * 
     * @param string  $label          Label text
     * @param array   $values         Key/value pair array
     * @param string  $validationRule Name of the validation rule thats required
     * to validate the field
     * @param boolean $required       Set to true if the rule is required or not
     * 
     * @return \aw\html\element\Label
     */
    public static function getNewLabelAndSelect(
        $label, 
        $values,  
        $validationRule = null,
        $required = false
    ) {
        $name = self::slugify($label);
        
        // Start creating/adding fields and adding them to the fieldset
        $label = new \aw\html\element\Label(
            $label, 
            array('for' => $name)
        );
        $select = \aw\html\element\Select::factory(
            $name, 
            $values,
            array(
                'id' => $name
            )
        );
        $label->addChild($select);

        // Add validation rule if required
        if ($validationRule) {
            $select->setRule($validationRule)
                ->getRule()
                ->setRequired($required);
        }
        return $label;
    }
    
    
    /**
     * Create a new label and child field of specified type
     * 
     * @param string  $type           Field Type
     * @param string  $label          Label name
     * @param string  $validationRule Name of the validation rule thats required
     * to validate the field
     * @param boolean $required       Set to true if the rule is required or not
     * 
     * @return \aw\html\element\Label
     */
    private static function _getNewLabelAndField(
        $type,  
        $label,  
        $validationRule = null,
        $required = false
    ) {
        $name = self::slugify($label, '_');
        $label = new \aw\html\element\Label(
            $label, 
            array('for' => $name)
        );
        
        $field = sprintf('aw\html\element\%s', $type);

        $tf = new $field(
            $name, 
            array(
                'id' => $name
            )
        );
        
        // Add field to label
        $label->addChild($tf);

        // Add validation rule if required
        if ($validationRule) {
            $tf->setRule($validationRule)
                ->getRule()
                ->setRequired($required);
        }

        return $label;
    }
}