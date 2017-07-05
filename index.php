<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 04.07.2017
 * Time: 20:56
 */

ini_set('display_errors', 1);
require 'config/route.php';

$readyContent = isset($allRouts[$actualRoute]) ? $allRouts[$actualRoute] : $allRouts['error'];

/**
 * @66todo РАЗОБРАТЬСЯ С КЕЙСОМ:
 * В пути роута больше трёх параметров типа /ваф/выа/ваы/выа
 */

if ($readyContent == $allRouts['error']) {
    require 'view/error.php';
} else {
    if(!is_array($readyContent)) {
        include $readyContent;
    } else {
        require (__DIR__ . '/controller/' . $readyContent['controller'] . '.php');
        logout::logout();
    }
}