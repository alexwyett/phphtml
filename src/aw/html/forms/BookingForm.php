<?php

/**
 * Booking Form object
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
 * Booking form object.  Extends the brochure form and provides other fields 
 * necessary to connect with the tabs api.
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
class BookingForm extends StaticForm
{
    /**
     * Constructor
     * 
     * @param array   $attributes Form attributes
     * @param array   $formValues Form Values
     * @param array   $countries  Countries in alpha2 => Name format
     * @param array   $sources    Array of sources in Code => Name format
     * @param array   $extras     Array of optional extras in Code => Label format
     * @param integer $adults     Number of adults
     * @param integer $children   Number of Children
     * @param integer $infants    Number of Infants
     * 
     * @return void
     */
    public static function factory(
        $attributes = array(),
        $formValues = array(),
        $countries = array(),
        $sources = array(),
        $extras = array(),
        $adults = 1,
        $children = 0,
        $infants = 0
    ) {
        $form = BrochureForm::factory(
            $attributes, 
            $formValues, 
            $countries, 
            $sources
        );
        
        // Add notes field to form
        $ta = StaticForm::getNewLabelAndTextArea(
            'Do you have any special requirements?'
        );
        $form->getElementBy('getClass', 'optional-details')->addChild($ta);
        
        // Add adult party details
        $fs = \aw\html\element\Fieldset::factory('About your Party');
        for ($i = 1; $i <= $adults; $i++) {
            $elements = self::getPartyDetailRow($i);
            $ele = \aw\html\element\Fieldset::factory(
                'Adult ' . $i,
                array(),
                $elements
            );
            $fs->addChild($ele);
        }
        
        // Add child party details
        for ($i = 1; $i <= $children; $i++) {
            $elements = self::getPartyDetailRow($i);
            $ele = \aw\html\element\Fieldset::factory(
                'Child ' . $i,
                array(),
                $elements
            );
            $fs->addChild($ele);
        }
        
        // Add optional extras fieldset if required
        if (count($extras) > 0) {
            $fs = \aw\html\element\Fieldset::factory('Optional Extras');
            foreach ($extras as $code => $extra) {
                $ele = self::getNewLabelAndCheckboxField($extra)
                    ->getElementBy('getType', 'checkbox')
                    ->setName($code);
                $fs->addChild($ele);
            }
        }
        
        // Add party details to form
        $form->addChild($fs);
        
        // Move submit down to bottom
        $form->getElementBy('getType', 'submit')->moveDown();
        
        return $form->mapValues();
    }
    
    /**
     * Return elements for a party detail row
     * 
     * @param integer $number Party detail number
     * @param string  $type   Type of party member, adult, child
     * 
     * @return array
     */
    public static function getPartyDetailRow($number, $type = 'adult')
    {
        $title = self::getNewLabelAndSelect(
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
        )->getElementBy('getType', 'select')
            ->setId($type . '_' . $number . '_title')
            ->setName($type . '_' . $number . '_title')
            ->getParent();
        
        $firstName = self::getNewLabelAndTextField(
            'First Name'
        )->getElementBy('getType', 'text')
            ->setId($type . '_' . $number . '_firstname')
            ->setName($type . '_' . $number . '_firstname')
            ->getParent();
        
        $surname = self::getNewLabelAndTextField(
            'Last Name',
            'ValidString',
            true
        )->getElementBy('getType', 'text')
            ->setId($type . '_' . $number . '_surname')
            ->setName($type . '_' . $number . '_surname')
            ->getParent();
        
        $age = self::getNewLabelAndTextField(
            'Age',
            'ValidNumber',
            true
        )->getElementBy('getType', 'text')
            ->setId($type . '_' . $number . '_age')
            ->setName($type . '_' . $number . '_age')
            ->getParent();
        
        return array(
            $title,
            $firstName,
            $surname,
            $age
        );
    }
}