<?php

/**
 * Login Form example
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

session_start();
$form = \aw\html\forms\LoginForm::factory(
    array(), 
    filter_input_array(INPUT_GET)
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

if (filter_input_array(INPUT_GET) 
    && count(filter_input_array(INPUT_GET)) > 0
    && $form->verifyNonce()
) {
    echo $form->validate();
} else {
    echo $form;
}