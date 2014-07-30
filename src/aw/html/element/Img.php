<?php

/**
 * Image element
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
 * Image element
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
class Img extends \aw\html\base\Element
{
    /**
     * Constructor
     * 
     * @param string $src        Image src
     * @param array  $attributes Element attributes
     * 
     * @return \aw\html\base\Element
     */
    public function __construct($src, $attributes = array())
    {
        parent::__construct($src, $attributes);
		$this->setAttribute('src', $src);
		$this->setTemplate('<{getType}{implodeAttributes} />');
    }
}
