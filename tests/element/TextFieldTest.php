<?php

/**
 * TextField PHPUnit Test case
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
 * TextField PHPUnit Test case
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
class TextFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * Text field
     * 
     * @var \aw\html\element\Input
     */
    public $textField;

    /**
     * Setup a new text field object with each test
     * 
     * @return void
     */
    public function setUp()
    {
        $this->textField = new \aw\html\element\Input(
            'textfield', 
            array(
                'id' => 'textfield',
                'class' => 'textfield'
            )
        );

        // Add a value to the text field
        $this->textField->setValue('A Value');

        // Add another class
        $this->textField->addClass('testing');

        // Add simple validation
        $this->textField->setRule('ValidString');
    }

    /**
     * Test textfield object
     * 
     * @return void
     */
    public function testNewTextField()
    {
        $this->assertEquals('textfield', $this->textField->getId());
        $this->assertEquals('textfield testing', $this->textField->getClass());

        // Remove the class attribute
        $this->textField->popAttribute('class');

        // Test the output
        $this->assertEquals('<input type="text" id="textfield" name="textfield" value="A Value">', (string) $this->textField);

        // Change the id field
        $this->textField->setId('newId');

        // Test the output
        $this->assertEquals('<input type="text" id="newId" name="textfield" value="A Value">', (string) $this->textField);


        $textField2 = new \aw\html\element\Input(
            'textfield', 
            array(
                'id' => 'textfield',
                'class' => 'textfield'
            )
        );
        // Test that the text field is not required to be tested at the
        // moment
        $this->assertFalse($textField2->isRequired());
        
        // Test setting the required field on a new validation rule
        $textField2->setRule('ValidSlug', true);
        $this->assertTrue($textField2->isRequired());
        
        // Test setting the required field on a new validation rule
        $textField2->setRule('ValidSlug', false);
        $this->assertFalse($textField2->isRequired());
    }

    /**
     * Test textfield validation
     * 
     * @return void
     */
    public function testTextFieldValidation()
    {
        $this->assertFalse($this->textField->isRequired());

        $this->textField->getRule()->setRequired(true);
        $this->assertTrue($this->textField->isRequired());

        // Add a value to the text field
        $this->textField->setValue('Another value');
        $this->assertEquals('Another value', $this->textField->getValue());
        $this->assertEquals('Another value', $this->textField->getRule()->getValue());

        // Test validation
        $this->assertNull($this->textField->getRule()->validateNull());
        $this->assertNull($this->textField->getRule()->validateString());
        $this->assertTrue($this->textField->getRule()->validate());
    }

    /**
     * Test that an exception is thrown when a non existent method is called
     * 
     * @expectedException \RuntimeException
     * 
     * @return void
     */
    public function testNonExistentMethod()
    {
        $this->textField->foo();
    }
    
    /**
     * Test date validation
     * 
     * @return void
     */
    public function testDateValidation()
    {
        $this->assertTrue(
            $this->textField->setRule('ValidDate')->setValue('now')->getRule()->validate()
        );
        $this->assertTrue(
            $this->textField->setRule('ValidDate')->setValue('10 September 2000')->getRule()->validate()
        );
        $this->assertTrue(
            $this->textField->setRule('ValidDate')->setValue('+1 day')->getRule()->validate()
        );
        $this->assertTrue(
            $this->textField->setRule('ValidDate')->setValue('+1 week')->getRule()->validate()
        );
        $this->assertTrue(
            $this->textField->setRule('ValidDate')->setValue('next Thursday')->getRule()->validate()
        );
        $this->assertTrue(
            $this->textField->setRule('ValidDate')->setValue('last Monday')->getRule()->validate()
        );
    }
    
    /**
     * Test slug validation
     * 
     * @return void
     */
    public function testSlugValidation()
    {
        $this->assertTrue(
            $this->textField->setRule('ValidSlug')->setValue('this-is-ok')->getRule()->validate()
        );
        $this->assertTrue(
            $this->textField->setRule('ValidSlug')->setValue('thisisalsook')->getRule()->validate()
        );
        $this->assertTrue(
            $this->textField->setRule('ValidSlug')->setValue('this_is_also_ok')->getRule()->validate()
        );
        $this->assertTrue(
            $this->textField->setRule('ValidSlug')->setValue('This_Is-also_ok')->getRule()->validate()
        );
    }
    
    /**
     * Test email validation
     * 
     * @return void
     */
    public function testEmailValidation()
    {
        $this->assertTrue(
            $this->textField->setRule('ValidEmail')->setValue('email@example.com')->getRule()->validate()
        );
    }

    /**
     * Test that an exception is thrown on validation failure
     * 
     * @dataProvider validationProvider
     * 
     * @return void
     */
    public function testTextFieldValidationExceptionCode(
        $rule,
        $value,
        $code,
        $message,
        $toString
    ) {
        try {
            $this->textField->setRule($rule)->setValue($value)->getRule()->validate();
        } catch (\aw\html\validation\ValidationException $ex) {
            $this->assertEquals($code, $ex->getCode());
            $this->assertEquals($message, $ex->getMessage());
            $this->assertEquals($toString, (string) $ex);
        }
    }
    
    /**
     * Test the validation on a date value
     * 
     * @param mixed $value Test values
     * 
     * @expectedException aw\html\validation\ValidationException
     * @expectedExceptionCode 1006
     * @expectedExceptionMessage Date is invalid
     * 
     * @dataProvider invalidDateValidationProvider
     * 
     * @return void
     */
    public function testInvalidDateValidation($value)
    {
        $rule = aw\html\validation\ValidDate::factory($value);
        
        $this->textField->setRule($rule)->getRule()->validate();
    }
    
    /**
     * Return an array of invalid date formats
     * 
     * @return array
     */
    public function invalidDateValidationProvider()
    {
        return array(
            array(
                ''
            ),
            array(
                false
            ),
            array(
                true
            ),
            array(
                'foo'
            ),
            array(
                1223123123
            ),
            array(
                new stdClass()
            )
        );
    }
    
    /**
     * Test the validation on a date value
     * 
     * @expectedException aw\html\validation\ValidationException
     * @expectedExceptionCode 1007
     * @expectedExceptionMessage 01-01-2012 is less than the minimum date of 01-01-2013
     * 
     * @return void
     */
    public function testMinDateValidation()
    {
        $rule = aw\html\validation\ValidDate::factory('01-01-2012');
        $rule->setMinDate('01-01-2013');
        $rule->setMaxDate('31-12-2014');
        
        $rule->validate();
    }
    
    /**
     * Test the validation on a date value
     * 
     * @expectedException aw\html\validation\ValidationException
     * @expectedExceptionCode 1008
     * @expectedExceptionMessage 01-01-2012 is greater than the maximum date of 01-01-2011
     * 
     * @return void
     */
    public function testMaxDateValidation()
    {
        $rule = aw\html\validation\ValidDate::factory('01-01-2012');
        $rule->setMinDate('01-01-2011');
        $rule->setMaxDate('31-12-2011');
        
        $rule->validate();
    }
    
    /**
     * Return validation provision
     * 
     * @return array
     */
    public function validationProvider()
    {
        return array(
            array(
                'Valid',
                null,
                1000,
                'Required',
                'aw\html\validation\ValidationException: [1000]: Required'
            ),
            array(
                'ValidString',
                '',
                1001,
                'Required',
                'aw\html\validation\ValidationException: [1001]: Required'
            ),
            array(
                'ValidEmail',
                '',
                1001,
                'Required',
                'aw\html\validation\ValidationException: [1001]: Required'
            ),
            array(
                'ValidEmail',
                'email@',
                1002,
                'Invalid email address',
                'aw\html\validation\ValidationException: [1002]: Invalid email address'
            ),
            array(
                'ValidEmail',
                'invalidemail',
                1002,
                'Invalid email address',
                'aw\html\validation\ValidationException: [1002]: Invalid email address'
            ),
            array(
                'ValidSlug',
                '',
                1001,
                'Required',
                'aw\html\validation\ValidationException: [1001]: Required'
            ),
            array(
                'ValidSlug',
                null,
                1000,
                'Required',
                'aw\html\validation\ValidationException: [1000]: Required'
            ),
            array(
                'ValidSlug',
                'S*&(s8978f-',
                1005,
                'Alpha/Numeric characters only',
                'aw\html\validation\ValidationException: [1005]: Alpha/Numeric characters only'
            ),
            array(
                'ValidSlug',
                'DFDSFDS)(*DF^(',
                1005,
                'Alpha/Numeric characters only',
                'aw\html\validation\ValidationException: [1005]: Alpha/Numeric characters only'
            ),
            array(
                'ValidSlug',
                'DFDSFDS',
                1005,
                'Alpha/Numeric characters only',
                'aw\html\validation\ValidationException: [1005]: Alpha/Numeric characters only'
            ),
            array(
                'ValidSlug',
                '____',
                1005,
                'Alpha/Numeric characters only',
                'aw\html\validation\ValidationException: [1005]: Alpha/Numeric characters only'
            ),
            array(
                'ValidSlug',
                '--__',
                1005,
                'Alpha/Numeric characters only',
                'aw\html\validation\ValidationException: [1005]: Alpha/Numeric characters only'
            ),
            array(
                'ValidDate',
                'notavaliddate',
                1006,
                'Date is invalid',
                'aw\html\validation\ValidationException: [1006]: Date is invalid'
            )
        );
    }
}