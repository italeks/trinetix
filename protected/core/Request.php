<?php

/**
 * sublime-text2: set identation by spaces and tabwidth =4
 * 
 * PHP version 5
 * 
 * @category   PHP
 * @package    Trinetix_Test
 * @subpackage Core
 * @author     Oleksii Dmytrenko <xdm@ukr.net>
 * @license    GNU General Public License version 2 or later; see LICENSE
 * @link       google.com
 */

/**
 * Request class
 * TODO : POST and COOKIE
 */

class Request
{
    public function get($name)
    {
        if (array_key_exists($name, $_GET)) {
            return $_GET[$name];
        }

        return '';
    }
}