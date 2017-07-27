<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 04.07.2017
 * Time: 20:56
 */

include_once "model/mainConfig.php";
define("DB",model\mainConfig::getInstance()->allConfig[1]['config_status']);
define("ISADMIN",preg_match("/admin/",$_SERVER["REQUEST_URI"]));
require 'config/route.php';

if(ISADMIN) {
    if(file_exists(__DIR__ . "/view/cache.dat")) {
        unlink(__DIR__ . "/view/cache.dat");
    }
}

$readyContent = isset($allRouts[$actualRoute]) ? $allRouts[$actualRoute] : $allRouts['error'];

/**
 * @todo РАЗОБРАТЬСЯ С КЕЙСОМ:
 * В пути роута больше трёх параметров типа /ваф/выа/ваы/выа
 */

if ($readyContent == $allRouts['error']) {
    require 'view/error.php';
} else {
    if(!is_array($readyContent)) {
        include $readyContent;
    } else {
        require (__DIR__ . '/controller/' . $readyContent['controller'] . '.php');
        $params = isset($readyContent['params']) ? $readyContent['params'] : null;
        $controller = new $readyContent['controller']($params);
    }
}