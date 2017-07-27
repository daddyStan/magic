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
        $this->deleteOrder($_POST['delete']);
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

        $f = scandir($this->uploaddir);
        $this->db->dbQueryResourceReturn("insert into `content` (`name`, `title`, `text`, `img`, `dop_text`, `main_title`, `date_changed`, `order`) 
                                    VALUES ('img','','','" . $my_file_destination_name . "', '', '', '" . date('Y-m-d') . "', '" . (count($f)-3) . "');");
        header('Location: /admin');
    }

    public function mainTitle() {
        $this->db->dbQueryResourceReturn("update `content` set `title`='" . $_POST['title'] . "', `text`='" . $_POST['imguslugiaddmaintitle'] . "' where `content_id`='49';");
        header('Location: /admin');
    }

    public function up() {
        $id = $_POST['id'];
        $dir = $this->uploaddir;
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
        $dir = $this->uploaddir;
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

    public function deleteOrder($id) {
        $dir = $this->uploaddir;
        $f = scandir($dir);
        $arr = [];
        foreach ($f as $file){
            if($file != '..' && $file != '.') {
                $row = $this->db->getRowByImg($file);
                if($row) {
                    $arr[$row['order']] = $row['content_id'];
                }
                $row['content_id'] == $id ? $idOrder = $row['order'] : $idOrder = false;
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
            $this->db->dbQueryResourceReturn("update `content` set `order`='" . $value . "'  where `content_id`='" . $key. "';");
        }
    }

}
