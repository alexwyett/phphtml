<?php

/**
 * Option group element
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
 * Option group element
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
class Optgroup extends Label
{
    /**
     * Factory method for creating an option group box
     * 
     * @param string $label       Optgroup label
     * @param array  $values      Values of the optgroup options in key/val pair
     * @param array  $attributes  Element attributes
     * 
     * @return \aw\html\element\Optgroup
     */
    public static function factory(
        $label, 
        $values = array(),
        $attributes = array()
    ) {
        $optgroup = new Optgroup($label, $attributes);
        foreach ($values as $key => $val) {
            // Support for the optgroup object
            if (is_object($val)) {
                $optgroup->addChild($val);
            } else if (is_array($val)) {
                $optgroup->addChild(
                    new Option($key, $val)
                );
            } else {
                $optgroup->addChild(
                    new Option(
                        $key,
                        array('value' => $val)
                    )
                );
            }
        }

        return $optgroup;
    }
    
    /**
     * Constructor
     * 
     * @param string $label      Label Text
     * @param array  $attributes Optgroup attributes
     * 
     * @return void
     */
    public function __construct($label, $attributes = array())
    {
        parent::__construct($label, $attributes);
        
        // Set the template
        $this->setTemplate(
            '<{getType} label="{getText}"{implodeAttributes}>{renderChildren}</{getType}>'
        );
    }
}
