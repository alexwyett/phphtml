<?php

/**
 * Next list element.  Takes a multi-dimensional array of data and converts
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
class NestedList extends \aw\html\base\HtmlElement
{
    /**
     * Create a nested list of items
     * 
     * @param array  $items Multi-dimensional array of items to output
     * 
     * @return \aw\html\element\NestedList
     */
    public static function factory($items)
    {
        $list = new NestedList();
        return $list->build($items);
    }
    
    /**
     * Constructor
     * 
     * @param array $attributes Element attributes
     * 
     * @return \aw\html\base\HtmlElement
     */
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
        $this->setType('ul');
    }
    
    /**
     * Create a nested list of items
     * 
     * @param array  $items Multi-dimensional array of items to output
     * 
     * @return \aw\html\element\NestedList
     */
    public function build($items)
    {
        foreach ($items as $key => $item) {
            $li = new Li($item);
            $this->addChild($li);
            if (is_array($item)) {
                $li->setText($key);
                $child = new NestedList($this->getAttributes());
                if (isset($item['attributes'])) {
                    $li->setAttributes($item['attributes']);
                    unset($item['attributes']);
                    if (isset($item['children'])) {
                        $li->addChild(
                            $child->build(
                                $item['children']
                            )
                        );
                    }
                } else {
                    $li->addChild(
                        $child->build(
                            $item['children']
                        )
                    );
                }
            }
        }
        
        return $this;
    }
}
