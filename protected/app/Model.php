<?php

/**
 * sublime-text2: set identation by spaces and tabwidth =4
 * 
 * PHP version 5
 * 
 * @category   PHP
 * @package    Trinetix_Test
 * @subpackage Application
 * @author     Oleksii Dmytrenko <xdm@ukr.net>
 * @license    GNU General Public License version 2 or later; see LICENSE
 * @link       google.com
 */

/**
 * Data Model
 */

class Model
{
    public $database;
    public $table = 'items_tree';
    public $allFields = 'id, name, level, right_key, left_key, FLOOR((right_key - left_key - 1) / 2) as children_count';

    public function __construct()
    {
        $factory = new Factory();
        $this->database = $factory->getDb();
    }
    
    public function getItemById($id)
    {
        $query = 'SELECT ' . $this->allFields . ' FROM ' . $this->table;
        $query .= ' WHERE id = :id';

        $query = $this->database->prepare($query);
        $query->execute(array(':id' => $id));

        $items = $query->fetchAll(PDO::FETCH_ASSOC);

        return $items[0] ;
    }

    public function getChildren($itemId, $depth = false)
    {

        $item = $this->getItemById($itemId);

        $query = 'SELECT ' . $this->allFields . ' FROM ' . $this->table;
        $query .= ' WHERE left_key > ' . $item['left_key'];
        $query .= ' AND right_key < ' . $item['right_key'];

        if ($depth) {
            $query .= ' AND level <= :level';   
        }

        $query .= ' ORDER BY left_key';

        $query = $this->database->prepare($query);
        $query->execute(array(':level' => $item['level'] + $depth));

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getRootItems(){

        $query = 'SELECT ' . $this->allFields . ' FROM ' . $this->table;
        $query .= ' WHERE level = 1 ORDER BY left_key';

        $query = $this->database->prepare($query);
        $query->execute();

        return $query->fetchAll();
    }
}