<?php

/**
 * Address form object
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
 * Address form object.  Extends the generic form and provides a static helper
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
class AddressForm extends StaticForm
{
    /**
     * Factory method
     * 
     * @param array $attributes Form attributes
     * @param array $formValues Form Values
     * @param array $countries  Countries in Name => Alpha2 format
     * 
     * @return \aw\html\element\Form
     */
    public static function factory(
        $attributes = array(),
        $formValues = array(),
        $countries = array()
    ) {
        // New form object
        $form = new \aw\html\element\Form($attributes, $formValues);
        
        // Fieldset
        $fs = \aw\html\element\Fieldset::factory(
            'Your Address',
            array(
                'class' => 'your-address'
            )
        );
        
        $formElements = array(
            'addr1' => array(
                'label' => 'House Name / Number',
                'rule' => 'ValidString',
                'required' => true
            ),
            'addr2' => array(
                'label' => 'Street name'
            ),
            'town' => array(
                'label' => 'Town / City',
                'rule' => 'ValidString',
                'required' => true
            ),
            'county' => array(
                'label' => 'County',
                'rule' => 'ValidString',
                'required' => true
            ),
            'postcode' => array(
                'label' => 'Post code',
                'rule' => 'ValidString',
                'required' => true
            )
        );
        
        foreach ($formElements as $name => $ele) {
            $label = StaticForm::getNewLabelAndTextField(
                $ele['label'],  
                (isset($ele['rule']) ? $ele['rule'] : null),
                (isset($ele['required']) ? $ele['required'] : null)
            );
            $fs->addChild(
                $label
            );
        }
        
        if (count($countries) > 0) {
            
            $label = StaticForm::getNewLabelAndSelect(
                'Country', 
                $countries,  
                'ValidString',
                true
            );
            
            $fs->addChild($label);
        }
        
        // Add fieldset to form
        $form->addChild($fs);
        
        // Add submit button
        $form->addChild(
            new \aw\html\element\Submit(
                array(
                    'value' => 'Submit Form'
                )
            )
        );
        
        return $form->mapValues();
    }
}