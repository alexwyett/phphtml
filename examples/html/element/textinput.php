<?php

/**
 * Paragraph element example
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

// Instantiate a new text field
$tf = new \aw\html\element\Input('test');

// Output field
echo $tf;

// Instantiate a new text field with attributes
$tf2 = new \aw\html\element\Input(
    'test2',
    array(
        'class' => 'testClass',
        'value' => 'Test2'
    )
);

// Output field
echo $tf2;

// Check value
echo $tf2->getValue();

// Instantiate a new text field to validate
$tf3 = new \aw\html\element\Input('test');
$tf3->setRule('ValidString')->setValue('Test 3');

// Outputs true as value is now set
var_dump($tf3->getRule()->validate());

// Output field
echo $tf3;