<?php

/**
 * Search form object
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
 * Search form object.  Extends the generic form and provides a static helper
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
class SearchForm extends StaticForm
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
        $formValues = array(),
        $prefix = ''
    ) {
        // New form object
        $form = new \aw\html\element\Form($attributes, $formValues);
        
        // Fieldset
        $fs = \aw\html\element\Fieldset::factory(
            'Search for Cottages',
            array(
                'class' => 'cottage-search'
            )
        );
        
        // Add name & submit button
        $fs->addChildren(
            array(
                self::getNewLabelAndTextField(
                    'Cottage Name'
                )->getElementBy('getType', 'text')
                    ->setName($prefix . 'name')
                    ->getParent(),
                new \aw\html\element\Submit(
                    array(
                        'value' => 'Submit Form'
                    )
                )
            )
        );
        
        // Add fieldset to form
        $form->addChild($fs);
        
        return $form->mapValues();
    }
    
    // ----------------------- Accessor Methods -------------------------- //
}