<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 27.07.2017
 * Time: 22:31
 */

require ('root.php');

class configController extends root
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

    public function site() {
        $as = $_POST['status'] == 'true' ? 1 : 0;
        $query = "UPDATE `config` SET `config_status`='" . $as . "' WHERE `config_id`='1'";
        if($this->db->dbQueryResourceReturn($query)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}