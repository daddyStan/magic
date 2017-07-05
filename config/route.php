<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 04.07.2017
 * Time: 21:01
 */

$actualRoute = $_SERVER["REQUEST_URI"];

$allRouts = [
//    '/' => 'view/index.php',
    '/' => 'view/zahlyshka.php',
    'error' => 'view/error.php',
    '/admin' => 'view/admin/index.php',
    '/zag' => 'view/index.php',
];