<?php

/**
 * Owner Pack form object
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
 * Owner Pack form object.  Users Customer form and address form to create a 
 * super form!
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
class OwnerpackForm extends StaticForm
{
    /**
     * Constructor
     * 
     * @param array $attributes Form attributes
     * @param array $formValues Form Values
     * @param array $countries  Countries in alpha2 => Name format
     * @param array $sources    Array of sources in Code => Name format
     * 
     * @return void
     */
    public static function factory(
        $attributes = array(),
        $formValues = array(),
        $countries = array(),
        $sources = array()
    ) {
        // New form object
        $form = new \aw\html\element\Form($attributes, $formValues);
        
        $contactform = ContactForm::factory();
        $form->addChild($contactform->getElementBy('getType', 'fieldset'));
        
        $addressform = AddressForm::factory(array(), array(), $countries);
        $form->addChild($addressform->getElementBy('getType', 'fieldset'));

        // Set the value of the country field to default to UK
        $form->getElementBy('getName', 'country')->setValue('GB');
        
        // Fieldset
        $fs = \aw\html\element\Fieldset::factory(
            'Property Details',
            array(
                'class' => 'property-details'
            )
        );
        
        // Start creating/adding fields and adding them to the fieldset
        $fs->addChild(
            self::getNewLabelAndTextField(
                'Where is your property located?',
                'ValidString',
                true
            )->getElementBy('getType', 'text')
                ->setName('where')
                ->getParent()
        );

        $fs->addChild(
            self::getNewLabelAndSelect(
                'Are you currently letting?', 
                array(
                    'Select' => '',
                    'Yes' => 'Yes',
                    'No' => 'No'
                ),
                'ValidString',
                true
            )->getElementBy('getType', 'select')
                ->setName('currentlyLetting')
                ->getParent()
        );
        
        // Create textarea for property description
        $lbl = new \aw\html\element\Label(
            'Please briefly describe your property',
            array(
                'for' => 'about'
            )
        );
        
        // Add to fieldset
        $fs->addChild(
            $lbl->addChild(
                new \aw\html\element\Textarea(
                    'about', 
                    array('id' => 'about')
                )
            )
        );
        
        
        if (count($sources) > 0) {
            $fs->addChild(
                self::getNewLabelAndSelect(
                    'Where did you here about us?', 
                    $sources,
                    'ValidString',
                    true
                )->getElementBy('getType', 'select')
                    ->setName('source')
                    ->getParent()
            );
        } else {
            $fs->addChild(
                new \aw\html\element\Hidden(
                    'source',
                    array(
                        'value' => 'OTH'
                    )
                )
            );
            $fs->addChild(
                self::getNewLabelAndTextField(
                    'Where did you here about us?',
                    'ValidString',
                    true
                )->getElementBy('getType', 'text')
                    ->setName('other')
                    ->getParent() // Need to return the parent as the getElementBy
                // accessor returns the text field not the label
            );
        }
        
        // Add optional details form
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