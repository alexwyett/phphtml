<?php

/**
 * Nexted list element example
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

$list = \aw\html\element\Ol::factory(range(1, 20));
echo $list;

$list2 = \aw\html\element\Ul::factory(
    array(
        1,
        2 => array(
            'attributes' => array(
                'style' => 'font-weight: bold; font-style: italic;'
            )
        ),
        3,
        "test" => array(
            'children' => array(
                4,
                5,
                "testing" => array(
                    'attributes' => array(
                        'style' => 'font-style: italic;'
                    ),
                    'children' => array(
                        6,
                        7,
                        8
                    )
                ),
                9,
                10
            )
        ),
        11,
        12
    )
);
echo $list2;