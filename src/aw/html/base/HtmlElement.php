<?php

/**
 * Base element which allows child elements
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

namespace aw\html\base;

/**
 * Base element which allows child elements
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
abstract class HtmlElement extends \aw\html\base\ChildElement
{
    // ------------------------- Public Methods ---------------------------- //
        
    /**
     * Constructor
     * 
     * @param string $text       Element Text
     * @param array  $attributes Element attributes
     * 
     * @return \aw\html\base\TextElement
     */
    public function __construct($text, $attributes = array())
    {
        parent::__construct($attributes);
        $this->setTemplate(
            '<{getType}{implodeAttributes}>{renderChildren}</{getType}>'
        );
    }
}