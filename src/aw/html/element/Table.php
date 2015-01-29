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

namespace aw\html\element;

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
    /**
     * Static factory method for creating a html table
     *
     * @param array $data       Data for the tbody section
     * @param array $headers    Table columns
     * @param array $attributes Table attributes
     *
     * @return \aw\html\element\Table
     */
    public static function factory($data = array(), $headers = array(), $attributes = array())
    {
        // Create new table element
        $table = new Table($attributes);
        
        // Construct header
        $thead = $table->addChild(new Thead());
        $tr = $thead->addChild(new Tr());
        foreach ($headers as $header) {
            $th = new Th('');
            if (is_string($header)) {
                $th->setText($header);
            } else {
                foreach ($header as $key => $val) {
                    $method = 'set' . ucfirst($key);
                    $th->$method($val);
                }
            }
            $tr->addChild($th);
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