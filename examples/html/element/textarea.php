<?php

/**
 * Textarea example
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
require_once dirname(__FILE__) . '/../../../autoload.php';

// Instantiate a new text area field
$ta = new \aw\html\element\Textarea('test');

// Output field
echo $ta;

// Instantiate a new text area field with attributes
$tf2 = new \aw\html\element\Textarea(
    'test2',
    array(
        'class' => 'testClass',
        'value' => 'Test'
    )
);

// Output field
echo $tf2;