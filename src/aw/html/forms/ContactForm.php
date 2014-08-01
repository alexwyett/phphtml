<?php

/**
 * Contact form object
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
 * Contact form object.  Extends the generic form and provides a static helper
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
class ContactForm extends StaticForm
{
    /**
     * Constructor
     * 
     * @param array $attributes Form attributes
     * @param array $formValues Form Values
     * 
     * @return void
     */
    public static function factory(
        $attributes = array(),
        $formValues = array()
    ) {
        // New form object
        $form = new \aw\html\element\Form($attributes, $formValues);
        
        // Fieldset
        $fs = \aw\html\element\Fieldset::factory(
            'Your Details',
            array(
                'class' => 'your-details'
            )
        );
        
        // Add fieldset to form
        $form->addChild($fs);
        
        // Start creating/adding fields and adding them to the fieldset
        $fs->addChild(
            self::getNewLabelAndSelect(
                'Title', 
                array(
                    'Mr' => 'Mr',
                    'Mrs' => 'Mrs',
                    'Miss' => 'Miss',
                    'Ms' => 'Ms',
                    'Dr' => 'Dr',
                    'Prof' => 'Prof',
                    'Rev' => 'Rev',
                ),
                'ValidString',
                true
            )
        );
        
        // Add initials
        $fs->addChild(self::getNewLabelAndTextField('Initial'));
        
        // Add surname
        $fs->addChild(self::getNewLabelAndTextField('Surname', 'ValidString', true));
        
        // Add email
        $fs->addChild(self::getNewLabelAndTextField('Email', 'ValidEmail'));
        
        // Add telephone
        $fs->addChild(self::getNewLabelAndTextField('Telephone', 'ValidString', true));
        
        // Add mobile telephone
        $fs->addChild(self::getNewLabelAndTextField('Mobile'));
        
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