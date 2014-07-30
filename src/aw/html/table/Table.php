<?php

/**
 * Table element
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
 * Table element
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
    public static function factory($data = array(), $headers = array())
    {
        $table = new Table();
        
        // Construct header
        $thead = $table->addChild(new Thead());
        $tr = $thead->addChild(new Tr());
        foreach ($headers as $header) {
            $tr->addChild(new Th($header));
        }
        
        // Construct body
        $tbody = $table->addChild(new Tbody());
        foreach ($data as $tableTr) {
            $tr = $tbody->addChild(new Tr());
            foreach ($tableTr as $tableTd) {
                $tr->addChild(new Td($tableTd));
            }
        }
        
        return $table;
    }
}