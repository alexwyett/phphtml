<?php

/**
 * Brochure Form example
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

// Include autoloader
require_once '../../../autoload.php';

$form = \aw\html\forms\BrochureForm::factory(
    array(), 
    filter_input_array(INPUT_GET),
    array(
        'Select' => '',
        'United Kingdom' => 'GB'
    ),
    array(
        'Select' => '',
        \aw\html\element\Optgroup::factory(
            'Internet',
            array(
                'Google' => 'GOO',
                'Yahoo!' => 'YAH',
                'MSN' => 'MSN'
            )
        ),
        \aw\html\element\Optgroup::factory(
            'Newspapers / Magazines',
            array(
                'The Times' => 'TIM',
                'The Independent' => 'IND',
                'The Guardian' => 'GUA',
                'The Sun' => 'SUN'
            )
        )
    )
);

// Apply a different template to each of the labels
$form->each('getType', 'label', function($label) {
    $label->setTemplate(
        '<div class="row">'
            . '<div class="col">'
            . ' <label{implodeAttributes}>{getText}</label>'
            . '</div>'
            . '<div class="col">'
            . '{renderChildren}'
            . '</div>'
        . '</div>'
    );
});

if (count(filter_input_array(INPUT_GET))) {
    echo $form->validate();
} else {
    echo $form;
}