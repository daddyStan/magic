<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 08.07.2017
 * Time: 23:01
 */

require ('root.php');

class imageloader extends root
{
    public function __construct()
    {
        require (__DIR__ . '/../model/db.php');
        $db = model\DB::getInstance();
        $uploaddir = __DIR__ . '/../assets/img/slider/';

        if ($_FILES['slider']['name'] != "") {
            $my_file_tmp_name = $_FILES['slider']['tmp_name'];
            $my_file_error_flag = $_FILES['slider']['error'];
            $my_file_destination_name = "file" . date('ydmhms') . ".jpg";

            if ($my_file_error_flag == 0) {
                if (move_uploaded_file($my_file_tmp_name, $uploaddir.''.$my_file_destination_name)) {
                } else {
                }
            }
        }
        $f = scandir($uploaddir);
        $db->dbQueryResourceReturn("insert into `content` (`name`, `title`, `text`, `img`, `dop_text`, `main_title`, `date_changed`, `order`) 
                                    VALUES ('img','','','" . $my_file_destination_name . "', '', '', '" . date('Y-m-d') . "', '" . (count($f) - 2)  . "');");

        header('Location: /admin');
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
}