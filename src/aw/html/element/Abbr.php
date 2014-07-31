<?php

/**
 * Abbreviation element
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
 * Abbreviation element
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
class Abbr extends \aw\html\base\Element
{
    /**
     * Constructor
     * 
     * @param string $title      Abbreviation
     * @param array  $attributes Element attributes
     * 
     * @return \aw\html\base\Element
     */
    public function __construct($title, $attributes = array())
    {
        parent::__construct($title, $attributes);
		$this->setAttribute('title', $title);
		$this->setTemplate('<{getType}{implodeAttributes} />');
    }
}
