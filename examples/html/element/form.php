<?php

/**
 * Form example
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
require_once 'selectfield.php';

$sf->setRule('Valid');

// Reset the output buffer
ob_clean();

// Create new form
$form = new \aw\html\element\Form();
$form->addChild($sf);

// Output
echo $form->validate();


// Test a new form which store submitted values
$form2 = new \aw\html\element\Form(array(), filter_input_array(INPUT_GET));
$form2->addChild($sf2);

// Add radio buttons
$form2->addChild(
    new \aw\html\element\Radio(
        'number',
        array('value' => 'one')
    )
);
$form2->addChild(
    new \aw\html\element\Radio(
        'number',
        array('value' => 'two')
    )
);

$form2->addChild(
    new \aw\html\element\Submit(
        array(
            'value' => 'Submit Form'
        )
    )
);

// Output new form
echo $form2->mapValues();