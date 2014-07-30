<?php

/**
 * AW PHPHtml autoloader.
 * 
 * Autoload inspired by the excellent fig-standard:
 * @see //github.com/php-fig/fig-standards
 *
 * PHP Version 5.3
 *
 * @category  PHPHtml
 * @package   AW
 * @author    Alex Wyett <alex@wyett.co.uk>
 * @copyright 2014 Alex Wyett
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.github.com/alexwyett
 */

spl_autoload_register(function($class) {
    
    // Project specific namespace
    $prefix = 'aw\\html\\';
    
    // Base directory
    $base_dir = __DIR__ . '/src/';
    
    // Does the class use this namespace?
    $len = strlen($prefix);
    
    // @codeCoverageIgnoreStart
    if (strncmp($prefix, $class, $len) !== 0) {
        // no
        return;
    }
    // @codeCoverageIgnoreEnd
    
    // Replace namespace prefix with the base directory, replace namepace
    // separators with directory separators in teh relative class name,
    // append with .class.php
    $file = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
    
});