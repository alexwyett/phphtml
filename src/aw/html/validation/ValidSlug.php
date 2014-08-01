<?php

/**
 * Slug Validation rules for form fields
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

namespace aw\html\validation;

/**
 * Slug Validation object
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
class ValidSlug extends ValidString
{
    /**
     * String validation
     * 
     * @return boolean
     */
    public function validateSlug()
    {
        if (!preg_match('/^[a-zA-Z0-9][-_a-zA-Z0-9]*$/', $this->getValue())) {
            // @codeCoverageIgnoreStart
            // TODO: Why does this not get covered in the unit tests?
            throw new ValidationException(
                'Alpha/Numeric characters only',
                1005
            );
            // @codeCoverageIgnoreEnd
        }
    }
}