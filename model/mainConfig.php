<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 27.07.2017
 * Time: 23:59
 */

namespace model;

class mainConfig {
    protected static $_instance;
    public $link;
    public $allContent = [];
    public $allConfig = [];

    private function __construct(){
        require_once (__DIR__ . '/../config/common.php');
        $this->link = mysqli_connect(
            HOST,
            USER,
            PASSWORD,
            DBNAME,
            PORT);
        $this->link->set_charset("utf8");
        $this->allConfig = $this->getAllConfig();
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
    public function dbQueryResourceReturn($query) {
        $raw = mysqli_query($this->link,$query);
        if($raw){return $raw;}
        return null;
    }

    public function getAllConfig() {
        $rawContent = $this->dbQueryResourceReturn('select * from `config`;');
        if($rawContent) {
            while ($row = mysqli_fetch_object($rawContent)) {
                $this->allConfig[$row->config_id] =
                    [
                        'config_id' => $row->config_id,
                        'config_name' => $row->config_name,
                        'config_status' => $row->config_status,
                        'options' => $row->options
                    ];
            }
        }

        return $this->allConfig;
    }
}