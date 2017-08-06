<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 06.08.2017
 * Time: 1:27
 */

namespace model;


class log
{
    public $date;
    public $db;
    public $logSubject;
    public $dop;

    public function __construct($db)
    {
        $this->date = date('Y-m-d-H-i-s');
        $this->db = $db;
    }

    public function logIt($logSubject,$dop = '') {
        $this->db->dbQuery("INSERT INTO `log`(`text`, `data`, `dop`) VALUES ('$logSubject','$this->date','$dop')");
    }

}