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

$p = new \aw\html\P('Hello World! ');
$p->addChild(new aw\html\A('Click Me', 'http://google.com'));

$div = new aw\html\bootstrap\Div('Hi');
$div->addChild($p);
echo $div;