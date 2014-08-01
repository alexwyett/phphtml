<?php

/**
 * Form Helper class. Provides static methods to build html forms that
 * have data memory
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
 * Form Helper class. Provides static methods to build html forms that
 * have data memory
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
class Form extends \aw\html\base\HtmlElement
{
    /**
     * Key/value pair array of form values (for persistence)
     * 
     * @var array
     */
    protected $formValues = array();
    
    /**
     * Form validation errors.  This will be a collection of exception objects
     * 
     * @var array
     */
    protected $errors = array();
    
    /**
     * Callback function
     * 
     * @var function
     */
    protected $callback = null;

    /**
     * Constructor
     * 
     * @param array $attributes Form attributes
     * @param array $formValues Form Values
     * 
     * @return void
     */
    public function __construct(
        $attributes = array(),
        $formValues = array()
    ) {
        parent::__construct($attributes);
        $this->setFormValues($formValues);
    }
    
    /**
     * Form validate function
     * 
     * @return \aw\html\element\Form
     */
    public function validate()
    {
        $this->validateForm();
		
        return $this;
    }
    
    /**
     * Form validate function
     * 
     * @return void
     */
    public function validateForm()
    {
        $form = $this;
        return self::traverseChildren(
            $this,
            function ($ele) use (&$form) {
                if (method_exists($ele, 'getRule') && $ele->getRule()) {
                    try {
                        $ele->getRule()->validate();
                    } catch (\aw\html\validation\ValidationException $e) {
                        $form->setError($ele->getName(), $e->getMessage());
                        if (is_callable($form->getCallback())) {
                            call_user_func_array(
                                $form->getCallback(), 
                                array($form, $ele, $e)
                            );
                        } else {
                            $ele->addClass('required')
                            ->setTemplate(
                                $ele->getTemplate() . ' ' . $e->getMessage()
                            );
                        }
                    }
                }
                return;
            }
        );
    }
    
    /**
     * Slug function - using this to convert label names into form 
     * element names
     * 
     * @see http://cubiq.org/the-perfect-php-clean-url-generator
     * 
     * @param string $str       String to slugify
     * @param string $delimiter Separator to use
     * 
     * @return string
     */
    public static function slugify($str, $delimiter='-')
    {
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }
    
    // ---------------------- Accessor Methods ----------------------------- //
        
    /**
     * Set form values
     * 
     * @param array $formValues Attribute name
     * 
     * @return \aw\html\element\Form
     */
    public function setFormValues($formValues)
    {
        if (is_array($formValues)) {
            $this->formValues = $formValues;
        }
        
        return $this;
    }
    
    /**
     * Retrieve form values
     * 
     * @return array
     */
    public function getFormValues()
    {
        return $this->formValues;
    }
    
    /**
     * Return the callback
     *
     * @return function
     */
    public function getCallback()
    {
        return $this->callback;
    }
    
    /**
     * Return a specific form value or false
     * 
     * @param string $key Array key
     * 
     * @return mixed
     */
    public function getFormValue($key)
    {
        $values = $this->getFormValues();
        if (array_key_exists($key, $values)) {
            return $values[$key];
        }
        return false;
    }
    
    /**
     * Return any form errors which may have been set from validating the form
     * 
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * Set a validation error
     * 
     * @param string $element Element name
     * @param string $error   Error string
     * 
     * @return \aw\html\element\Form
     */
    public function setError($element, $error)
    {
        $this->errors[$element] = $error;
		
        return $this;
    }
    
    /**
     * Set the validation callback.  The function has three arguments, $form
     * $ele and $e which are the form object, element object and exception
     * object respectively.  I.e: 
     * 
     * $this->setCallback(function($form, $ele, $e) { // do stuff });
     * 
     * @param function $func Function to use as the validation call back
     * 
     * @return \aw\html\element\Form
     */
    public function setCallback($func)
    {
        $this->callback = $func;
		
        return $this;
    }
    
    // -------------------------- Helper Methods -------------------------- //
    
    /**
     * Return tue if the form has no errors
     * 
     * @return boolean
     */
    public function isValid()
    {
        return (count($this->getErrors()) == 0);
    }
    
    /**
     * Public mapping function. Returns the form object for chain-ability(?!)
     * 
     * @return \aw\html\element\Form
     */
    public function mapValues()
    {
        $this->_mapValues();
		
        return $this;
    }
    
    /**
     * Mapping function to set form elements to their form values
     * 
     * @return void
     */
    private function _mapValues()
    {
        $form = $this;
        return self::traverseChildren(
            $this,
            function ($ele) use ($form) {
                if ($ele->getName() 
                    && array_key_exists($ele->getName(), $form->getFormValues())
                ) {
                    if (method_exists($ele, 'setChecked') 
                        && (
                            $ele->getValue() == $form->getFormValue($ele->getName())
                            || $form->getFormValue($ele->getName()) == 'on'
                        )
                    ) {
                        $ele->setChecked(true);
                    }
                    
                    if (!method_exists($ele, 'setChecked')) {
                        $ele->setValue($form->getFormValue($ele->getName()));
                    }
                }
                return;
            }
        );
    }
}