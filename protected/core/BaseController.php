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
 * Base Controller
 */
abstract class BaseController
{

    protected $request, $model, $view, $appDirectory;

    abstract public function execute();

    public function run()
    {
        
        $this->request = new Request();
        $this->model = new Model();

        if($this->isAjaxRequest()) {
            $this->outputJson($this->ajax());
        }
        $this->view = $this->getTemplate();
        $this->params = $this->execute();
        $this->replaceParams();
        $this->outputHtml();
    }

    protected function replaceParams()
    {
        foreach ($this->params as $key => $value) {
            $this->view = str_replace('{' . $key . '}', $value, $this->view);
        }
        //clear unfound params
        $this->view = preg_replace('/{[a-z_-]+}/i', '', $this->view);
    }

    private function getTemplate()
    {
        $viewFilePath = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'app/layout.html';
        return file_get_contents($viewFilePath);
    }
    
    protected function outputHtml()
    {
        header("Content-type:text/html");
        echo $this->view ;
        die() ;
    }

    protected function outputJson($json)
    {
        header("Content-type:text/json");
        echo $json ;
        die() ;
    }

    public function isAjaxRequest()
    {
        //if ajax header received
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            return true;
        }
        //for test purposes
        if (@$_GET['ajax'] === '1') {
            return true;
        }

        return false;
    }
}