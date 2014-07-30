<?php

/**
 * String Validation rules for form fields
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
 * String Validation object
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
class ValidDate extends Valid
{
    /**
     * Max Date
     * 
     * @var \DateTime
     */
    protected $maxDate;
    
    /**
     * Less than
     * 
     * @var \DateTime
     */
    protected $minDate;
    
    /**
     * Return the maxDate time check
     * 
     * @return DateTime
     */
    public function getMaxDate()
    {
        return $this->maxDate;
    }
    
    /**
     * Return the minDate time check
     * 
     * @return DateTime
     */
    public function getMinDate()
    {
        return $this->minDate;
    }
    
    /**
     * Set a max date
     * 
     * @param string $date String representation of a date
     * 
     * @return \aw\html\validation\Valid
     */
    public function setMaxDate($date)
    {
        $this->maxDate = new \DateTime($date);
        
        return $this;
    }
    
    /**
     * Set a min date
     * 
     * @param string $date String representation of a date
     * 
     * @return \aw\html\validation\Valid
     */
    public function setMinDate($date)
    {
        $this->minDate = new \DateTime($date);
        
        return $this;
    }
    
    /**
     * String validation
     * 
     * @return boolean
     */
    public function validateDate()
    {
        if (!$this->_isDateValid($this->getValue())) {
            throw new \aw\html\validation\ValidationException(
                'Date is invalid',
                1006
            );
        }
        
        $date = new \DateTime($this->getValue());
        
        // Check date is greater than min date
        if ($this->getMinDate() && $date <= $this->getMinDate()) {
            throw new \aw\html\validation\ValidationException(
                sprintf(
                    '%s is less than the minimum date of %s', 
                    $this->getValue(),
                    $this->getMinDate()->format('d-m-Y')
                ),
                1007
            );
        }
        
        // Check date is less than max date
        if ($this->getMaxDate() && $date > $this->getMaxDate()) {
            throw new \aw\html\validation\ValidationException(
                sprintf(
                    '%s is greater than the maximum date of %s', 
                    $this->getValue(),
                    $this->getMinDate()->format('d-m-Y')
                ),
                1008
            );
        }
    }
    
    /**
     * Check a string is valid date
     * 
     * @param string $str Date string
     * 
     * @return boolean
     */
    private function _isDateValid($str)
    {
        if (!is_string($str)) {
            return false;
        }

        $stamp = strtotime($str); 
        if (!is_numeric($stamp)) {
            return false; 
        }
        
        return true;
    }
}