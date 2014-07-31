<?php

/**
 * Address Form example
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

$form = \aw\html\forms\AddressForm::factory(
    array(), 
    filter_input_array(INPUT_GET),
    array(
        'Select' => '',
        'United Kingdom' => 'GB'
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

// Set the value of the country field to default to UK
$form->getElementBy('getName', 'country')->setValue('GB');

if (count($_GET)) {
    echo $form->validate();
} else {
    echo $form;
}