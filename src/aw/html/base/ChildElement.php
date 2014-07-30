<?php

/**
 * Base element which allows child elements
 *
 * PHP Version 5.3
 *
 * @category  FormFields
 * @package   AW
 * @author    Alex Wyett <alex@wyett.co.uk>
 * @copyright 2013 Alex Wyett
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.github.com/alexwyett
 */

namespace aw\html\base;

/**
 * Element object
 *
 * PHP Version 5.3
 * 
 * @category  FormFields
 * @package   AW
 * @author    Alex Wyett <alex@wyett.co.uk>
 * @copyright 2013 Alex Wyett
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.github.com/alexwyett
 */
abstract class ChildElement extends \aw\html\base\Element
{
    /**
     * Children
     * 
     * @var array
     */
    protected $children = array();
    
    // ------------------------- Public Methods ---------------------------- //

    /**
     * Add a child to the element
     * 
     * @param \aw\html\base\Element $child Elements child
     * 
     * @return \aw\html\base\ChildElement
     */
    public function addChild($child)
    {
        $child->setParent($this);
        $this->children[] = $child;
        return $this;
    }

    /**
     * Adds children to the element
     * 
     * @param array $children An array of child objects
     * 
     * @return \aw\html\base\ChildElement
     */
    public function addChildren($children)
    {
        foreach ($children as $child) {
            $this->addChild($child);
        }
        return $this;
    }
    
    /**
     * Loop function to apply a callback to a particular accessor pattern
     * 
     * @param string   $accessor Accessor method to call
     * @param string   $value    Comparison value
     * @param function $callback Callback function to apply
     * 
     * @return void
     */
    public function each($accessor, $value, $callback = null)
    {
        foreach ($this->getElementsBy($accessor, $value) as $ele) {
            if (is_callable($callback)) {
                $callback($ele);
            }
        }
    }
    
    /**
     * Swap an array index with another
     * 
     * @param integer $i
     * @param integer $j
     * 
     * @return \aw\html\base\ChildElement
     */
    public function swap($i, $j)
    {
        $a = $this->getChildren();
        $tmp = $a[$i];
        if ($i > $j) {
            for ($k = $i; $k > $j; $k--) {
                $a[$k] = $a[$k - 1];
            }
        } else {
            for ($k = $i; $k < $j; $k++) {
                $a[$k] = $a[$k + 1];
            }
        }
        $a[$j] = $tmp;
        $this->children = $a;
        return $this;
    }
    
    /**
     * Remove a child specified
     * 
     * @param integer $index Index of the child required to move
     * 
     * @return \aw\html\base\ChildElement
     */
    public function removeChild($index)
    {
        unset($this->children[$index]);
        return $this;
    }

    /**
     * Render object children
     * 
     * @return string
     */
    public function renderChildren()
    {
        $children = $this->getChildren();
        if (count($children) > 0) {
            return $this->_renderChildren($children, '');
        }
        return '';
    }
    
    // ------------------------- Accessor Methods -------------------------- //
    
    /**
     * Generic accessor.  To be used for selecting multiple elements at the
     * same time.  Selector strings are in the format of:
     * 
     * attribute|type[value],attribute|type[value]....n
     * 
     * For example:
     * 
     * id[name],class[address],type[checkbox]
     * 
     * This will return any elements with an id of name, a class of address
     * or any checkbox fields.
     * 
     * @param string $selector Selector statment
     * 
     * @return \aw\html\base\ChildElement|array
     */
    public function get($selector)
    {
        // Explode the string with commas
        $selectors = explode(',', $selector);
        
        // Array to return
        $objects = array();
        
        // Loop through selectors and extrac
        foreach ($selectors as $selector) {
            preg_match('/(\w+)\[(\w+)\]/is', $selector, $matches);
            if (count($matches) == 3) {
                $method = 'get' . ucfirst(trim($matches[1]));
                $value = $matches[2];
                foreach ($this->getElementsBy($method, $value) as $ele) {
                    array_push(
                        $objects,
                        $ele
                    );
                }
            }
        }
        
        // TODO: Remove duplicates        
        return array_values(array_filter($objects));
    }

    /**
     * Return the element children
     * 
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }
    
    /**
     * Return a child object from the parent
     * 
     * @param integer $index Index of child
     * 
     * @return \aw\html\base\ChildElement
     */
    public function getChild($index)
    {
        return $this->children[$index];
    }
    
    /**
     * Return a child object or objects from the parent
     * 
     * @param string $accessor Accessor method to call
     * @param string $value    Comparison value
     * 
     * @return array
     */
    public function getElementsBy($accessor, $value)
    {
        $elements = $this->getElementBy($accessor, $value);
        if (!is_array($elements)) {
            $elements = array($elements);
        }
        return $elements;
    }
    
    /**
     * Return a child object or objects from the parent
     * 
     * @param string  $accessor Accessor method to call
     * @param string  $value    Comparison value
     * @param integer $index    Index of array to return if you're sure the
     * method will return an array!
     * 
     * @return \aw\html\base\ChildElement|Array
     */
    public function getElementBy($accessor, $value, $index = null)
    {
        $objects = array();
        self::traverseChildren(
            $this, 
            function ($ele) use ($accessor, $value, &$objects) {
                if (method_exists($ele, $accessor)) {
                    if ($value === $ele->$accessor()) {
                        array_push($objects, $ele);
                    }
                }
            }
        );
        
        // Set index to be the first element if there is only one
        // element in the array
        if (count($objects) == 1) {
            $index = 0;
        }
        
        if (is_numeric($index) && isset($objects[$index])) {
            return $objects[$index];
        } else {
            return $objects;
        }
    }

    /**
     * Return true if element has children
     * 
     * @return boolean
     */
    public function hasChildren()
    {
        return (count($this->getChildren()) > 0);
    }
    
    // -------------------------- Helper Methods -------------------------- //

    /**
     * Child traversal function
     * 
     * @param object   $object   Object to traverse
     * @param function $callback Callback function to apply to child object
     * 
     * @return void
     */
    public static function traverseChildren($object, $callback)
    {
        call_user_func($callback, $object);
        if (method_exists($object, 'hasChildren')) {
            foreach ($object->getChildren() as $child) {
                self::traverseChildren($child, $callback);
            }
        }
    }
    
    // -------------------------- Private Methods -------------------------- //

    /**
     * Add a child to the element
     * 
     * @param array  $children Elements child
     * @param string $output   Children output
     * 
     * @return void
     */
    private function _renderChildren(
        $children = array(), 
        $output = ''
    ) {
        if (count($children) > 0) {
            $child = array_shift($children);
            $output .= (string) $child;
            return $this->_renderChildren($children, $output);
        }
        return $output;
    }
}