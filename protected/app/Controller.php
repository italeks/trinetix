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
 * Application Controller
 */
class Controller extends BaseController
{
    public function execute()
    {
        $items = $this->model->getRootItems();
        $htmlList = '';

        foreach ($items as $item) {

            $htmlList .= '<li id="' . $item['id'] . '">' . $item['name'] ;
            $htmlList .= ' (' . $item['children_count'] . ')</li>' ; 
        }

        return array('items' => $htmlList);
    }

    public function ajax()
    {
        $itemId = $this->request->get('itemId');
        $depth = (int) $this->request->get('depth');

        $items = $this->model->getChildren($itemId, $depth);
        
        return json_encode($items, JSON_UNESCAPED_UNICODE);
    }
}