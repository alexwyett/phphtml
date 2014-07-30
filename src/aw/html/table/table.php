<?php

/**
 * Table head element
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

namespace aw\html\table;

/**
 * Table head element
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
class Table extends \aw\html\base\HtmlElement
{
    /**
     * 
     * @param type $data
     * @param type $headers
     * @return \aw\html\table\Table
     */
    public static function factory($data = array(), $headers = array())
    {
        $table = new Table();
        
        return $table;
    }
}