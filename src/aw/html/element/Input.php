<?php

/**
 * Textfield object
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
 * Textfield object
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
class Input extends \aw\html\base\FormElement
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
    public function __construct($name, $attributes = array(), $type = 'text')
    {
        // Add attributes
        parent::__construct($attributes);

        // Set element name
        $this->setName($name);
		
        // Set element type
        $this->setType($type);
        
        // Set the template
        $this->setTemplate(
            '<input type="{getType}"{implodeAttributes}>'
        );
    }
}