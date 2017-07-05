<?php
/**
 * Created by PhpStorm.
 * User: koshpaevsv
 * Date: 05.07.17
 * Time: 20:27
 */
require ('root.php');

class logout extends \root {

    public function __construct() {

    }

    public static function logout() {
        session_start();
        $_SESSION['auth'] = false;
        header('Location: /admin');
    }
}