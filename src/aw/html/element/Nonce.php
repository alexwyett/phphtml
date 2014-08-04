<?php

/**
 * Nonce input object
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
 * Nonce input object
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
class Nonce extends Hidden
{
    /**
     * Nonce value
     * 
     * @var string
     */
    protected $nonce = null;
    
    /**
     * Constructor
     * 
     * @param string $name       Field name
     * @param array  $attributes Field attributes
     * 
     * @return void
     */
    public function __construct($name, $attributes = array())
    {
        // Add attributes
        parent::__construct($name, $attributes, 'hidden');
        
        // Set the template
        $this->setTemplate(
            '<input type="{getType}" name="{getName}" value="{getValue}">'
        );
    }
    
    /**
     * Override the traditional behavior
     * 
     * @param string $value Value
     * 
     * @return \aw\html\element\Nonce
     */
    public function setValue($value)
    {
        return $this;
    }
    
    /**
     * Set the nonce value
     * 
     * @param string $nonce Nonce Value
     * 
     * @return \aw\html\element\Nonce
     */
    public function setNonce($nonce)
    {
        $this->nonce = $nonce;
        
        return $this;
    }
    
    /**
     * Get the nonce value
     * 
     * @return string
     */
    public function getValue()
    {
        return $this->nonce;
    }
}