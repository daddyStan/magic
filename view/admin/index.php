<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 04.07.2017
 * Time: 21:34
 */

require(__DIR__ . '/../../model/auth.php');
$authClass = new model\auth();

if($authClass->getAuth()) {
    include 'grid.php';
} else {
    include 'login_form.php';
}

?>