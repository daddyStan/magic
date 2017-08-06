<?php
/**
 * Created by PhpStorm.
 * User: koshpaevsv
 * Date: 27.07.17
 * Time: 16:47
 */

require ('root.php');

class slider extends root
{
    public $db;
    public $log;

    public function __construct($params=null)
    {
        require (__DIR__ . '/../model/db.php');
        require (__DIR__ . '/../model/log.php');
        $this->db = model\DB::getInstance();
        $this->log = new \model\log($this->db);

        if(!is_null($params)) {
            $method = $params['action'];
            $this->$method();
        } else {
            $this->actionIndex();
        }
    }

    public function up() {
        $id = $_POST['id'];
        $this->log->logIt("Инициирован подъем картинки вверх","ID: " . $id);
        $dir = __DIR__ . '/../assets/img/slider';
        $f = scandir($dir);
        $arr = [];
        foreach ($f as $file){
            if($file != '..' && $file != '.') {
                $row = $this->db->getRowByImg($file);
                if($row) {
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
            $this->log->logIt("Запрос: " . "update `content` set `order`='" . $key . "'  where `content_id`='" . $value. "';","ID: $id");
            $this->db->dbQueryResourceReturn("update `content` set `order`='" . $key . "'  where `content_id`='" . $value. "';");
        }
        echo "ok";
    }

    public function down() {
        $id = $_POST['id'];
        $this->log->logIt("Инициирован подъем картинки вниз","ID: " . $id);
        $dir = __DIR__ . '/../assets/img/slider';
        $f = scandir($dir);
        $arr = [];
        foreach ($f as $file){
            if($file != '..' && $file != '.') {
                $row = $this->db->getRowByImg($file);
                if($row) {
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
}