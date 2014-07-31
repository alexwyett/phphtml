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
class Submit extends \aw\html\base\HtmlElement
{
    /**
     * Constructor
     * 
     * @param array $attributes Field attributes
     * 
     * @return void
     */
    public function __construct($attributes = array())
    {
        // Add attributes
        parent::__construct($attributes);
        
        $this->setTemplate(
            '<input type="{getType}"{implodeAttributes}>'
        );
    }
}
