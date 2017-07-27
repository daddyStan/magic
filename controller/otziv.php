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

    public function text() {
        $this->db->dbQueryResourceReturn("INSERT INTO `content`(`name`, `text`, `date_changed`) VALUES ('otziv','" . $_POST['otzivnew'] . "','" . date('Y-m-d') . "')");
        header('Location: /admin');
    }

    public function delete() {
        if($this->db->dbQueryResourceReturn("DELETE FROM `content` WHERE `content_id`='" . $_POST['delete'] . "';")) {
            echo "1";
            $this->deleteOrder($_POST['delete'],$this->db);
        } else {
            echo "0";
        }
    }

    public function up() {
        $id = $_POST['id'];
        $dir = __DIR__ . '/../assets/img/magi';
        $f = scandir($dir);
        $arr = [];
        foreach ($f as $file){
            if($file != '..' && $file != '.') {
                $row = $this->db->getRowByImg($file);
                if($row && $row['content_id'] != 30) {
                    $arr[$row['order']] = $row['content_id'];
                }
            }
        }
        ksort($arr);
        $rezaultArray = [];
        foreach ($arr as $key => $value) {
            if($value == $id && count($arr) != $key) {
                $rezaultArray[$key] = $arr[$key + 1];
                $rezaultArray[$key + 1] = $id;
            }
        }
        foreach ($rezaultArray as $key => $value) {
            $this->db->dbQueryResourceReturn("update `content` set `order`='" . $key . "'  where `content_id`='" . $value. "';");
        }
        echo "ok";
    }

    public function down() {
        $id = $_POST['id'];
        $dir = __DIR__ . '/../assets/img/magi';
        $f = scandir($dir);
        $arr = [];
        foreach ($f as $file){
            if($file != '..' && $file != '.') {
                $row = $this->db->getRowByImg($file);
                if($row && $row['content_id'] != 30) {
                    $arr[$row['order']] = $row['content_id'];
                }
            }
        }
        ksort($arr);
        $rezaultArray = [];
        foreach ($arr as $key => $value) {
            if($value == $id && $key != 1) {
                $rezaultArray[$key] = $arr[$key - 1];
                $rezaultArray[$key - 1] = $id;
            }
        }

        foreach ($rezaultArray as $key => $value) {
            $this->db->dbQueryResourceReturn("update `content` set `order`='" . $key . "'  where `content_id`='" . $value. "';");
        }
        echo "ok";
    }

    public function upO() {
        $id = $_POST['id'];
        $arr = [];
        foreach ($this->db->allContent as $otziv) {
            if($otziv['name'] == 'otziv') {
                $arr[$otziv['order']] = $otziv['content_id'];
            }
        }
        ksort($arr);
        $rezaultArray = [];
        foreach ($arr as $key => $value) {
            if($value == $id && count($arr) != $key) {
                $rezaultArray[$key] = $arr[$key + 1];
                $rezaultArray[$key + 1] = $id;
            }
        }
        foreach ($rezaultArray as $key => $value) {
            $this->db->dbQueryResourceReturn("update `content` set `order`='" . $key . "'  where `content_id`='" . $value. "';");
        }
        echo "ok";
    }

    public function downO() {
        $id = $_POST['id'];
        $arr = [];
        foreach ($this->db->allContent as $otziv) {
            if($otziv['name'] == 'otziv') {
                $arr[$otziv['order']] = $otziv['content_id'];
            }
        }
        ksort($arr);
        $rezaultArray = [];
        foreach ($arr as $key => $value) {
            if($value == $id && $key > 1) {
                $rezaultArray[$key] = $arr[$key - 1];
                $rezaultArray[$key - 1] = $id;
            }
        }
        foreach ($rezaultArray as $key => $value) {
            $this->db->dbQueryResourceReturn("update `content` set `order`='" . $key . "'  where `content_id`='" . $value. "';");
        }
        echo "ok";
    }

    public function deleteOrder($id,$db) {
        $arr = []; 
        foreach ($this->db->allContent as $file){
            if($file['name'] == 'otziv') {
                $arr[$file['order']] = $file['content_id'];
                $file['content_id'] == $id ? $idOrder = $file['order'] : $idOrder = false;
            }
        }
        ksort($arr);
        $rezaultArray = [];
        foreach ($arr as $key => $value) {
            if($key > $idOrder) {
                $rezaultArray[$value] = $key - 1;
            }
        }
        foreach ($rezaultArray as $key => $value) {
            $db->dbQueryResourceReturn("update `content` set `order`='" . $value . "'  where `content_id`='" . $key. "';");
        }
    }
}