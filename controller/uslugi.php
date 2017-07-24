<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 10.07.2017
 * Time: 14:56
 */

require ('root.php');

class uslugi extends root
{
    public $uploaddir = __DIR__ . '/../assets/img/uslugi/';
    public $db;

    public function __construct($params=null)
    {
        require (__DIR__ . '/../model/db.php');
        $this->db = model\DB::getInstance();
        if(!is_null($params)) {
            $this->$params['action']();
        }
    }

    /**
     * @param $post
     * @return bool
     */
    public static function validate($post) {
        foreach ($post as $value) {
            if(empty($value)) {
                return false;
            }
        }
        return true;
    }

    public function imgzamenauslugi() {
        if ($_FILES['imgmagizamenauslugi']['name'] != "") {
            $my_file_tmp_name = $_FILES['imgmagizamenauslugi']['tmp_name'];
            $my_file_error_flag = $_FILES['imgmagizamenauslugi']['error'];
            $my_file_destination_name = "file" . date('ydmhms') . ".jpg";

            if ($my_file_error_flag < 1) {
                if (move_uploaded_file($my_file_tmp_name, $this->uploaddir.''.$my_file_destination_name)) {
                } else {
                }
            }
        }
        $oldImg = $this->db->dbQueryArryReturn("select * from `content` WHERE `content_id`='" . $_POST['content_id'] . "'");
        unlink(__DIR__ . '/../assets/img/uslugi/' . $oldImg[0]->img);
        $this->db->dbQueryResourceReturn("update `content` set `img`='" . $my_file_destination_name . "' where `content_id`='" . $_POST['content_id'] . "'");
        header('Location: /admin');
    }

    public function uslugitext() {
        $this->db->dbQueryResourceReturn("update `content` set `text`='" . $_POST['textuslugi'.$_POST['content_id']] . "', `title`='" . $_POST['uslugititle'] . "' where `content_id`='" . $_POST['content_id'] . "';");
        header('Location: /admin');
    }

    public function uslugidelete() {
        $this->db->dbQueryResourceReturn("update `content` set `img`='' where `content_id`='" . $_POST['delete'] . "';");
        $filename = __DIR__ . '/../assets/img/uslugi/' . $_POST['img'];
        unlink($filename);
        header('Location: /admin');
    }

    public function add() {
        if ($_FILES['imguslugiadd']['name'] != "") {
            $my_file_tmp_name = $_FILES['imguslugiadd']['tmp_name'];
            $my_file_error_flag = $_FILES['imguslugiadd']['error'];
            $my_file_destination_name = "file" . date('ydmhms') . ".jpg";

            if ($my_file_error_flag == 0) {
                if (move_uploaded_file($my_file_tmp_name, $this->uploaddir.''.$my_file_destination_name)) {
                } else {
                }
            }
        }
        $this->db->dbQueryResourceReturn("insert into `content` (`name`, `title`, `text`, `img`, `dop_text`, `main_title`, `date_changed`) 
                                    VALUES ('img','','','" . $my_file_destination_name . "', '', '', '" . date('Y-m-d') . "');");
        header('Location: /admin');
    }

    public function mainTitle() {
        $this->db->dbQueryResourceReturn("update `content` set `title`='" . $_POST['title'] . "', `text`='" . $_POST['imguslugiaddmaintitle'] . "' where `content_id`='49';");
        header('Location: /admin');
    }
}
