<?php

/**
 * Base element
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
 * Element object
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
abstract class Element
{
    /**
     * Id of element
     * 
     * @var string
     */
    protected $id;

    /**
     * Name of element
     * 
     * @var string
     */
    protected $name;
    
    /**
     * Class of element
     * 
     * @var string
     */
    protected $class = '';

    /**
     * Key/value pair array of element attributes
     * 
     * @var array
     */
    protected $attributes = array();
    
    /**
     * Element template
     * 
     * @var string
     */
    protected $template = '{getType}';
    
    /**
     * Type of element
     * 
     * @var string
     */
    protected $type = '';
    
    /**
     * Parent object
     * 
     * @var object reference
     */
    protected $parent = null;

    // ------------------------- Public Methods ---------------------------- //
        
    /**
     * Constructor
     * 
     * @param array $attributes Field attributes
     * 
     * @return aw\html\base\Element
     */
    public function __construct($attributes = array())
    {
        // Add attributes
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }
		
        // Set the element type
        $this->setType($this->getElementType());
    }

    /**
     * Append another Class
     * 
     * @param string $class Element Class
     * 
     * @return aw\html\base\Element
     */
    public function addClass($class)
    {
        return $this->setClass($this->getClass() . ' ' . $class);
    }
    
    /**
     * Append markup to the existing template
     * 
     * @param string $template Template string
     * 
     * @return \aw\html\base\Element
     */
    public function appendTemplate($template)
    {
        return $this->setTemplate($this->getTemplate() . $template);
    }
    
    /**
     * Move an item up the parent child index
     * 
     * @return \aw\html\base\Element
     */
    public function moveUp()
    {
        $index = $this->getIndex();
        if ($index > 0 && $this->getParent()) {
            $this->getParent()->swap($index, $index - 1);
        }
        return $this;
    }
    
    /**
     * Move an item down the parent child index
     * 
     * @return \aw\html\base\Element
     */
    public function moveDown()
    {
        $index = $this->getIndex();
        if ($this->getParent() 
            && $index < count($this->getParent()->getChildren())
        ) {
            $this->getParent()->swap($index, $index + 1);
        }
        return $this;
    }
        
    /**
     * Remove a field attribute
     * 
     * @param string $key Attribute key
     * 
     * @return void
     */
    public function popAttribute($key)
    {
        if (isset($this->attributes[$key])) {
            unset($this->attributes[$key]);

            // Remove property if that exists
            if (property_exists($this, $key)) {
                $this->$key = null;
            }
        }
    }
    
    /**
     * Prepend markup to the existing template
     * 
     * @param string $template Template string
     * 
     * @return \aw\html\base\Element
     */
    public function prependTemplate($template)
    {
        return $this->setTemplate($template . $this->getTemplate());
    }
    
    /**
     * Implode the current element attributes into a string
     * 
     * @return string
     */
    public function implodeAttributes()
    {
        $attrs = '';
        foreach ($this->getAttributes() as $key => $val) {
            $attrs .= $this->_renderAttribute($key, $val);
        }
        return $attrs;
    }
    
    /**
     * Remove the child from its parent
     * 
     * @return \aw\html\base\Element
     */
    public function remove()
    {
        $parent = $this->getParent();
        if ($parent) {
            $parent->removeChild($this->getIndex());
            $this->_removeParent();
        }
        return $parent;
    }
   
    /**
     * Function used to overwrite a string with the output of any 
     * accessor methods
     *
     * @param string   $template Template pattern
     * @param stdClass $object   Object
     * 
     * @return string
     */
    public function replaceObjectData($template, $object)
    {
        preg_match_all('#\{[^}]*\}#s', $template, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            if (isset($match[0])) {
                $method = str_replace('}', '', str_replace('{', '', $match[0]));
                $template = str_replace(
                    '{'.$method.'}', 
                    $object->$method(),
                    $template
                );
            }
        }
        
        return $template;
    }
    
    /**
     * Rendering function
     * 
     * @return string
     */
    public function render()
    {
        return $this->replaceObjectData($this->getTemplate(), $this);
    }
    
    /**
     * Render element
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
    
    // ------------------------- Accessor Methods -------------------------- //

    /**
     * Add an attribute to the array
     * 
     * @param array $key   Attribute name
     * @param array $value and value
     * 
     * @return void
     */
    public function setAttribute($key, $value)
    {
        // Check to see if a property with that attribute
        // name exists first and set its value too.
        if (property_exists($this, $key)) {
            $this->$key = $value;
        }

        // Set attribute value
        $this->attributes[$key] = $value;
        return $this;
    }
    
    /**
     * Set the Class
     * 
     * @param string $class Element Class
     * 
     * @return \aw\html\base\Element
     */
    public function setClass($class)
    {
        $this->class = $class;

        // Set attribute value
        $this->attributes['class'] = $this->getClass();

        return $this;
    }

    /**
     * Set the Id
     * 
     * @param string $id Element ID
     * 
     * @return \aw\html\base\Element
     */
    public function setId($id)
    {
        $this->id = $id;

        // Set attribute value
        $this->attributes['id'] = $this->getId();

        return $this;
    }
    
    /**
     * Set the Name
     * 
     * @param string $name Element Name
     * 
     * @return \aw\html\base\Element
     */
    public function setName($name)
    {
        $this->name = $name;

        // Set attribute value
        $this->attributes['name'] = $this->getName();

        return $this;
    }
    
    /**
     * Set a parent element reference
     * 
     * @param object &$parent Parent objects reference
     * 
     * @return \aw\html\base\Element
     */
    public function setParent(\aw\html\base\Element &$parent)
    {
        $this->parent = $parent;
        return $this;
    }
    
    /**
     * Set the template
     * 
     * @param string $template Element template
     * 
     * @return \aw\html\base\Element
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }
    
    /**
     * Set the type
     * 
     * @param string $type Element type
     * 
     * @return \aw\html\base\Element
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    /**
     * Retrieve a single attribute
     *
     * @param string $attributeName Attribute name you wish to search for
     * 
     * @throws \RuntimeException
     * 
     * @return mixed
     */
    public function getAttribute($attributeName)
    {
        if (array_key_exists($attributeName, $this->getAttributes())) {
            return $this->attributes[$attributeName];
        }

        throw new \RuntimeException(
            sprintf(
                'Attribute \'%s\' does not exist',
                $attributeName
            )
        );
    }
    
    /**
     * Retrieve attributes
     * 
     * @return void
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
    
    /**
     * Get the element class
     * 
     * @return string
     */
    public function getClass()
    {
        return trim($this->class);
    }
    
    /**
     * Get the element id
     * 
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Return the index of the element
     * 
     * @return integer
     */
    public function getIndex()
    {
        $index = 0;
        if ($this->getParent()) {
            foreach ($this->getParent()->getChildren() as $aIndex => $child) {
                if ($child === $this) {
                    $index = $aIndex;
                }
            }
        }
        return $index;
    }

    /**
     * Return the name of the element
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Return a parent object
     * 
     * @return \aw\formfields\fields\ParentElement
     */
    public function getParent()
    {
        return $this->parent;
    }
    
    /**
     * Return the element template
     * 
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }
    
    /**
     * Return the element type
     * 
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Get the field type
     * 
     * @return string
     */
    public function getElementType()
    {
        $type = explode('\\', strtolower(get_called_class()));
        
        return $type[count($type) - 1];
    }

    /**
     * Get magic method for creating attribute accessor methods on the fly
     * 
     * @param string $method Method Name
     * @param array  $args   Method args
    * 
     * @throws \RuntimeException
     * 
     * @return \aw\html\base\Element
     */
    public function __call($method, $args)
    {
        if (substr($method, 0, 3) == 'get') {
            $attributeName = substr(strtolower($method), 3);
            return $this->getAttribute($attributeName);
        }

        throw new \RuntimeException('Method ' . $method . ' not found');
    }
    
    // -------------------------- Private Methods -------------------------- //
    
    /**
     * Return a key=val string
     * 
     * @param string $key Key of value
     * @param string $val Attribute value
     * 
     * @return string 
     */
    private function _renderAttribute($key, $val)
    {
        return sprintf(
            ' %s="%s"',
            $key,
            $val
        );
    }
    
    /**
     * Remove the objects parent association
     * 
     * @return \aw\html\base\Element
     */
    private function _removeParent()
    {
        $this->parent = null;
        return $this;
    }
}