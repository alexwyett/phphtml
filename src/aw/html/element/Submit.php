<?php

/**
 * Submit element
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

namespace aw\html\element;

/**
 * Submit element
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
class Submit extends Input
{
    /**
     * Constructor
     * 
     * @param string $name       Field name
     * @param array  $attributes Field attributes
     * @param string $type       Field type (defaulted to text)
     * 
     * @return void
     */
    public function __construct($name, $attributes = array(), $type = 'submit')
    {
        // Add attributes
        parent::__construct($name, $attributes, $type);
    }
}
