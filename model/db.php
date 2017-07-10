<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 06.07.2017
 * Time: 23:21
 */
namespace model;


class DB {
    protected static $_instance;
    public $link;
    public $allContent = [];

    private function __construct(){
        require_once (__DIR__ . '/../config/common.php');
        $this->link = mysqli_connect(
            HOST,
            USER,
            PASSWORD,
            DBNAME,
            PORT);
        $this->link->set_charset("utf8");
    }

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    private function __clone(){}
    private function __wakeup(){}

    /**
 * @param $query
 * @return bool| \mysqli | array
 */
    public function dbQueryArryReturn($query) {
        $raw = mysqli_query($this->link,$query);

        if($raw){
            $arr = [];
            while( $row = mysqli_fetch_object($raw) ){
                $arr[] = $row;
            }

            return $arr;
        }

        return null;
    }

    /**
     * @param $query
     * @return bool| \mysqli | array
     */
    public function dbQueryResourceReturn($query) {
        $raw = mysqli_query($this->link,$query);
        if($raw){return $raw;}
        return null;
    }

    /**
     * @return mixed
     */
    public function getAllData() {
        $rawContent = $this->dbQueryResourceReturn('select * from `content`;');
        if($rawContent) {
            while ($row = mysqli_fetch_object($rawContent)) {
                $this->allContent[$row->content_id] =
                    [
                        'content_id' => $row->content_id,
                        'name' => $row->name,
                        'title' => $row->title,
                        'text' => $row->text,
                        'img' => $row->img,
                        'dop_text' => $row->dop_text,
                        'main_title' => $row->main_title,
                        'date_changed' => $row->date_changed
                    ];
            }
        }

        return $this->allContent;
    }

    public function getRowByImg($img = null) {
        if(!is_null($img)) {
            foreach($this->allContent as $value) {
                if($img == $value['img']) {
                    return $value;
                }
            }
        }

        return false;
    }
}