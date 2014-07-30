<?php

/**
 * Base element which allows child elements with a text element
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
 * Base element which allows child elements with a text element
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
abstract class TextElement extends \aw\html\base\ChildElement
{
    /**
     * Text
     * 
     * @var string
     */
    protected $text = '';

    // ------------------------- Public Methods ---------------------------- //
        
    /**
     * Constructor
     * 
     * @param string $text       Element Text
     * @param array  $attributes Element attributes
     * 
     * @return \aw\html\base\TextElement
     */
    public function __construct($text, $attributes = array())
    {
        parent::__construct($attributes);
        $this->setText($text);
        $this->setTemplate(
            '<{getType}{implodeAttributes}>{getText}{renderChildren}</{getType}>'
        );
    }
    
    // ------------------------- Accessor Methods -------------------------- //

    /**
     * Set the text of the html element
     * 
     * @param string $text Text value
     * 
     * @return \aw\html\base\TextElement
     */
    public function setText($text)
    {
        $this->text = $text;
        
        return $this;
    }
    
    /**
     * Return the text of the element
     * 
     * @return string;
     */
    public function getText()
    {
        return $this->text;
    }
}