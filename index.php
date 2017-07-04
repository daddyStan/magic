<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 04.07.2017
 * Time: 20:56
 */

ini_set('display_errors', 1);
require '/config/route.php';

$readyContent = isset($allRouts[$actualRoute]) ? $allRouts[$actualRoute] : $allRouts['error'];

echo $readyContent;