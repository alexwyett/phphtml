<?php

/**
 * Nested element.  Takes a multi-dimensional array of data and converts
 * it into a nested list.
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
 * Nested element.  Takes a multi-dimensional array of data and converts
 * it into a nested list.
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
abstract class NestedElement extends \aw\html\base\HtmlElement
{
    /**
     * Create a nested list of items
     * 
     * @param array $items Multi-dimensional array of items to output
     * 
     * @return \aw\html\base\NestedElement
     */
    public static function factory($items)
    {
        $list = new static();
        return $list->build($items);
    }
    
    // ------------------------- Public Methods ---------------------------- //
    
    /**
     * Create a nested list of items
     * 
     * @param array $items Multi-dimensional array of items to output
     * 
     * @return \aw\html\base\NestedElement
     */
    public function build($items)
    {
        foreach ($items as $key => $item) {
            $li = new \aw\html\element\Li($item);
            $this->addChild($li);
            if (is_array($item)) {
                $li->setText($key);
                $child = new static($this->getAttributes());
                if (isset($item['attributes'])) {
                    $li->setAttributes($item['attributes']);
                    unset($item['attributes']);
                    if (isset($item['children'])) {
                        $child->build(
                            $item['children']
                        );
                    }
                } else {
                    $child->build(
                        $item['children']
                    );
                }
                $li->addChild($child);
            }
        }
        
        return $this;
    }
}