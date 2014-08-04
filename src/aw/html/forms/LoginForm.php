<?php

/**
 * Login form object
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

namespace aw\html\forms;

/**
 * Login form object.  Extends the generic form and provides a static helper
 * method to build the form object
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
class LoginForm extends StaticForm
{
    /**
     * Factory method
     * 
     * @param array $attributes Form attributes
     * @param array $formValues Form Values
     * @param array $countries  Countries in Name => Alpha2 format
     * 
     * @return \aw\html\element\Form
     */
    public static function factory(
        $attributes = array(),
        $formValues = array()
    ) {
        // New form object
        $form = new \aw\html\element\Form($attributes, $formValues);
        $form->addNonce('login_form');
        
        // Fieldset
        $fs = \aw\html\element\Fieldset::factory(
            'Please Login',
            array(
                'class' => 'login-details'
            )
        );
        
        $formElements = array(
            'email' => array(
                'label' => 'Email Address',
                'type' => 'Input',
                'rule' => 'ValidEmail',
                'required' => true
            ),
            'password' => array(
                'label' => 'Password',
                'type' => 'Password',
                'rule' => 'ValidString',
                'required' => true
            )
        );
        
        foreach ($formElements as $name => $ele) {
            $label = new \aw\html\element\Label($ele['label']);
            $type = sprintf('\aw\html\element\%s', $ele['type']);
            $element = new $type($name);
            $element->setRule($ele['rule'], $ele['required']);
            $label->setId($name)->addChild($element);
            $fs->addChild(
                $label->setAttribute('for', $name)
            );
        }
        
        // Add fieldset to form
        $form->addChild($fs);
        
        // Add submit button
        $form->addChild(
            new \aw\html\element\Submit(
                array(
                    'value' => 'Login'
                )
            )
        );
        
        return $form->mapValues();
    }
}