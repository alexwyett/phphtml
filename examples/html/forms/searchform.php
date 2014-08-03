<?php

/**
 * TOCC Advanced search form example
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
require_once '../../../autoload.php';

$form = new \aw\html\forms\ToccAdvancedSearch(
    array(), 
    filter_input_array(INPUT_GET)
);

$form->setAreaSelect(
    $form->createBasicSelect(
        'Please choose an Area', 
        array(
            'Please choose an Area' => '',
            'Norfolk' => 'NORF',
            'Suffolk' => 'SUFF',
            'Kent' => 'KENT'
        ),
        'area', 
        'areaAdv'
    )
);

$form->setLocationSelect(
    $form->createBasicSelect(
        'Town/Village', 
        array(
            'Town/Village' => '',
            'Cranbrook' => array(
                'value' => 'CRAN',
                'class' => 'KENT'
            ),
            'Holt' => array(
                'value' => 'HOLT',
                'class' => 'NORF',
            ),
            'Reepham' => array(
                'value' => 'REEP',
                'class' => 'NORF',
            ),
            'Southwold' => array(
                'value' => 'SOUTH',
                'class' => 'SUFF'
            )
        ),
        'location', 
        'locationAdv'
    )
);

$form->setSearchAttribute('Short Breaks', 'ATTR11')
    ->setSearchAttribute('Close to Coast', 'ATTR138')
    ->setSearchAttribute('Pet Friendly', 'pets')
    ->setSearchAttribute('Private Parking', 'ATTR30')
    ->setSearchAttribute('Internet Access', 'ATTR38')
    ->setSearchAttribute('Garden/Courtyard', 'ATTR06')
    ->setSearchAttribute('Near a Pub', 'ATTR139')
    ->setSearchAttribute('On One Level', 'ATTR12')
    ->setSearchAttribute('Short Breaks', 'shortbreaktemplate')
    ->setSearchAttribute('Special Offers', 'specialOffer')
    ->setSearchAttribute('New Properties', 'ATTR91')
    ->setSearchAttribute('Featured Properties', 'promote');

$form->build();

// Start form theming
// Wrap Select fields
$form->each('getType', 'select', function($ele) {
    $ele->getParent()->setTemplate(
        '<label{implodeAttributes}><span>{getText}</span>{renderChildren}</label>'
    );
});

// Add separator between shortbreaks and featured properties checkboxes
$form->getElementBy('getId', 'shortbreaktemplate')->getParent()->prependTemplate('<div class="featured-attributes">');
$form->getElementBy('getId', 'promote')->getParent()->appendTemplate('</div>');

// Remove Submit button
$form->getElementBy('getType', 'submit')->remove();

// Set form template
$form->setTemplate(
    '<form{implodeAttributes}>
        <div class="form-inner">
            {renderChildren}
        </div>
        <div class="advanced-search-form-actions">
            <button class="view-cottages submit">Search Now<i></i></button>
            <span id="search-result-lead">Your search will find <strong>all</strong> of our cottages</span>
        </div>
     </form>'
        
);


echo $form->mapValues();