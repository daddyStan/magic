<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 24.07.2017
 * Time: 22:13
 */

require ('root.php');

class otziv extends root
{
    public $db;

    public function __construct($params=null)
    {
        require (__DIR__ . '/../model/db.php');
        $this->db = model\DB::getInstance();
        if(!is_null($params)) {
            $this->$params['action']();
        } else {
            $this->actionIndex();
        }
    }

    public function actionIndex () {

        foreach ($_POST as $key => $value) {
            $otziv_id = preg_replace("/otziv/","", $key);
            $this->db->dbQueryResourceReturn("update `content` set `text`='" . $value . "'  where `content_id`='" . $otziv_id . "';");
        }

        header('Location: /admin');
    }
}