<?php
/**
 * Created by PhpStorm.
 * User: koshpaevsv
 * Date: 05.07.17
 * Time: 18:58
 */

namespace model;

class auth {
    public $auth = false;

    public function __construct()
    {
        session_start();
        if(isset($_SESSION['auth'])) {
            if($_SESSION['auth']) {
                $this->auth = true;
            }
        } else {
            $_SESSION['auth'] = false;
        }
    }

    /**
     * @return bool
     */
    public function getAuth() {
        include_once (__DIR__ . '/../config/common.php');
        if (!$this->auth) {
            if(isset($_POST['pin'])) {
                if($_POST['pin'] == PIN) {
                    $_SESSION['auth'] = true;
                    return true;
                } else {
                    $_SESSION['auth'] = false;
                    return false;
                }
            }
        } else {
            return true;
        }
        return false;
    }

    public function logoff(){
        $_SESSION['auth'] = false;
    }

}