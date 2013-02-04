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
 * Provides core classes
 * TODO add Request here
 */

class Factory
{
    public function __construct(){}

    public function getDb()
    {
        switch (strtolower(DB_TYPE)) {
        case 'mysql':
            return DataProvider::getCursor(new MysqlConnector()); 
            
        default:
            return DataProvider::getCursor(new MysqlConnector());
        }
    }
}