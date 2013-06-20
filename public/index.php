<?php

require_once dirname(dirname(__FILE__)) . '/protected/settings.php';
require_once ROOT_FOLDER . '/core/database.php';

function __autoload($className)
{
    $includeFolders = array(
        ROOT_FOLDER . '/core/',
        ROOT_FOLDER . '/app/',
    ) ;


    foreach ($includeFolders as $folder) {
        if (file_exists($folder . $className . '.php')) {
            include_once $folder . $className . '.php';
        }
    }
}

$app = new Controller();
$app->run();

