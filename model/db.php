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
    public $connect;

    private function __construct(){
        require_once (__DIR__ . '/../config/common.php');
        echo "<br/><em>1.  Установка соединения с хостом...";
        //подключаемся к БД
        $this->connect = mysql_connect(HOST, USER, PASSWORD) or die("Невозможно установить соединение".mysql_error());
        // выбираем таблицу
        echo "<br/>2.  Выбор базы...";
        mysql_select_db(NAME_BD, $this->connect) or die ("Невозможно выбрать указанную базу".mysql_error());
    }

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    private function __clone(){}
    private function __wakeup(){}
}