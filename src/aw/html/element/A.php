<?php

/**
 * Anchor element
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
 * Anchor element
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
class A extends P
{
    /**
     * Constructor
     * 
     * @param string $text       Element Text
     * @param string $href       Anchor href
     * @param array  $attributes Element attributes
     * 
     * @return \aw\html\base\TextElement
     */
    public function __construct($text, $href, $attributes = array())
    {
        parent::__construct($text, $attributes);
        $this->setAttribute('href', $href);
    }
}
