<?php

/**
 * This example shows how to template the Brochure Form so that it will slot
 * in with twitters bootstrap css framework.
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

// Include autoloader
require_once 'brochureform.php';

// Reset the output buffer
ob_clean();

// Set form attributes
$form->setClass('form-horizontal')->setAttribute('role', 'form');

// Apply a different template to each of the labels
$form->each('getType', 'label', function($label) {
    $label->setClass('control-label col-sm-2')
        ->setTemplate(
        '<div class="form-group">
            <label{implodeAttributes}>{getText}</label>
            <div class="col-sm-5">
                {renderChildren}
            </div>
        </div>'
    );
});

$form->each('getType', 'text', function($textfield) {
    $placeholder = $textfield->getParent()->getText();
    $textfield->setClass('form-control')->setAttribute('placeholder', $placeholder);
});

$form->each('getType', 'select', function($textfield) {
    $textfield->setClass('form-control');
});

$form->each('getType', 'checkbox', function($checkbox) {
    $checkbox->getParent()
        ->setClass('')
        ->setTemplate(
            '<div class="form-group">
                <div class="col-sm-offset-2 col-sm-5">
                    <label{implodeAttributes}>{renderChildren} {getText}</label>
                </div>
            </div>'
        );
});

// Set the button template
$form->getElementBy('getType', 'submit')
    ->setClass('btn btn-primary btn-lg')
    ->setTemplate(
        '<div class="form-group">
            <div class="col-sm-offset-2 col-sm-5">
                <input type="{getType}"{implodeAttributes}>
            </div>
        </div>');

// Set the validation call back
$form->setCallback(
    function($form, $ele, $e) {
        $ele->getParent()->setTemplate(
            str_replace(
                'form-group', 
                'form-group has-error', 
                $ele->getParent()->getTemplate()
            )
        );
    }
);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Brochure Request form with a Bootstrap Theme</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>Bootstrap Brochure Form</h1>
            </div>
<?php

if (count(filter_input_array(INPUT_GET))) {
    echo $form->validate();
} else {
    echo $form;
}

?>            
        </div>
    </body>
</html>