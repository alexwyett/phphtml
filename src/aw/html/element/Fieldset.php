<?php

/**
 * Fieldset Helper class. 
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
 * Fieldset Helper class. 
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
class Fieldset extends \aw\html\base\HtmlElement
{
    /**
     * Factory method for easy creation
     * 
     * @param string $legend     The legend of the fieldset
     * @param array  $attributes Any attributes to be added
     * @param array  $children   Any child elements of the fieldset
     * 
     * @return \aw\html\element\Fieldset
     */
    public static function factory(
        $legend = '', 
        $attributes = array(), 
        $children = array()
    ) {
        $legend = new Legend($legend);
        array_unshift($children, $legend);
        $fs = new Fieldset($attributes);
        return $fs->addChildren($children);
    }
}