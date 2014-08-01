<?php

/**
 * Elements test functions
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

require_once '../autoload.php';

/**
 * Elements test functions
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
class ElementsTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test a text element and output
     * 
     * @param string $class          Element to create
     * @param string $text           Element text
     * @param array  $attributes     Attributes array
     * @param string $expectedOutput Expected output
     * 
     * @dataProvider textElementProvider
     * 
     * @return void
     */
    public function testTextElement($class, $text, $attributes, $expectedOutput)
    {
        $ns = "\\aw\\html\\element\\{$class}";
        $ele = new $ns($text, $attributes);
        
        $this->assertEquals($expectedOutput, (string) $ele);
    }
    
    /**
     * Data provider for testElement function
     * 
     * @return array
     */
    public function textElementProvider()
    {
        return array(
            array(
                'P',
                'Hello World!',
                array(),
                '<p>Hello World!</p>'
            ),
            array(
                'Abbr',
                'Hello World!',
                array(),
                '<abbr>Hello World!</abbr>'
            ),
            array(
                'Blockquote',
                'This is a blockquote',
                array(
                    'style' => 'font-weight: bold;'
                ),
                '<blockquote style="font-weight: bold;">This is a blockquote</blockquote>'
            ),
            array(
                'Del',
                'Hello World!',
                array(),
                '<del>Hello World!</del>'
            ),
            array(
                'Div',
                'Hello World!',
                array(),
                '<div>Hello World!</div>'
            ),
            array(
                'Em',
                'Hello World!',
                array(),
                '<em>Hello World!</em>'
            ),
            array(
                'H1',
                'Hello World!',
                array(),
                '<h1>Hello World!</h1>'
            ),
            array(
                'H2',
                'Hello World!',
                array(),
                '<h2>Hello World!</h2>'
            ),
            array(
                'H3',
                'Hello World!',
                array(),
                '<h3>Hello World!</h3>'
            ),
            array(
                'H4',
                'Hello World!',
                array(),
                '<h4>Hello World!</h4>'
            ),
            array(
                'H5',
                'Hello World!',
                array(),
                '<h5>Hello World!</h5>'
            ),
            array(
                'H6',
                'Hello World!',
                array(),
                '<h6>Hello World!</h6>'
            ),
            array(
                'Ins',
                'Hello World!',
                array(),
                '<ins>Hello World!</ins>'
            ),
            array(
                'Label',
                'Hello World!',
                array(),
                '<label>Hello World!</label>'
            ),
            array(
                'Legend',
                'Hello World!',
                array(),
                '<legend>Hello World!</legend>'
            ),
            array(
                'Li',
                'Hello World!',
                array(),
                '<li>Hello World!</li>'
            ),
            array(
                'Mark',
                'Hello World!',
                array(),
                '<mark>Hello World!</mark>'
            ),
            array(
                'S',
                'Hello World!',
                array(),
                '<s>Hello World!</s>'
            ),
            array(
                'Small',
                'Hello World!',
                array(),
                '<small>Hello World!</small>'
            ),
            array(
                'Strong',
                'Hello World!',
                array(),
                '<strong>Hello World!</strong>'
            ),
            array(
                'Td',
                'Hello World!',
                array(),
                '<td>Hello World!</td>'
            ),
            array(
                'U',
                'Hello World!',
                array(),
                '<u>Hello World!</u>'
            )
        );
    }
    
    /**
     * Test a html element and output
     * 
     * @param string $class          Element to create
     * @param array  $attributes     Attributes array
     * @param string $expectedOutput Expected output
     * 
     * @dataProvider htmlElementProvider
     * 
     * @return void
     */
    public function testHtmlElement($class, $attributes, $expectedOutput)
    {
        $ns = "\\aw\\html\\element\\{$class}";
        $ele = new $ns($attributes);
        
        $this->assertEquals($expectedOutput, (string) $ele);
    }
    
    /**
     * Data provider for testElement function
     * 
     * @return array
     */
    public function htmlElementProvider()
    {
        return array(
            array(
                'Ul',
                array(),
                '<ul></ul>'
            )
        );
    }
}