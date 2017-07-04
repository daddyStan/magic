<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 04.07.2017
 * Time: 21:01
 */

$actualRoute = $_SERVER["REQUEST_URI"];

$allRouts = [
    '/' => 'view/index.php',
    'error' => '/view/error.php'
];