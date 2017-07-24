<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 09.07.2017
 * Time: 22:37
 */

require ('root.php');

class magi extends root
{
    public function __construct($params=null)
    {
        require (__DIR__ . '/../model/db.php');
        $db = model\DB::getInstance();
        $uploaddir = __DIR__ . '/../assets/img/magi/';
        $this->params = $params;

        if(!is_null($this->params)) {
            switch ($this->params['main_mag']) {
                case 'img':
                    if ($_FILES['mag']['name'] != "") {
                        $my_file_tmp_name = $_FILES['mag']['tmp_name'];
                        $my_file_error_flag = $_FILES['mag']['error'];
                        $my_file_destination_name = "file" . date('ydmhms') . ".jpg";

                        if ($my_file_error_flag < 1) {
                            if (move_uploaded_file($my_file_tmp_name, $uploaddir.''.$my_file_destination_name)) {
                            } else {
                            }
                        }
                    }
                    $oldImg = $db->dbQueryArryReturn("select * from `content` WHERE `content_id`='30'");
                    unlink(__DIR__ . '/../assets/img/magi/' . $oldImg[0]->img);
                    $db->dbQueryResourceReturn("update `content` set `img`='" . $my_file_destination_name . "' where `content_id`='30'");
                    header('Location: /admin');
                    break;
                case 'text':
                    $db->dbQueryResourceReturn("update `content` set `text`='" . $_POST['main_mag'] . "' where `content_id`='30' ");
                    header('Location: /admin');
                    break;
                case 'magitext':
                    foreach ($_POST as $key => $value) {
                        $db->dbQueryResourceReturn("update `content` set `text`='" . $value . "', `title`='" . $_POST['magititle'] . "' where `content_id`='" . $key . "';");
                    }
                    header('Location: /admin');
                    break;
                case 'imgmagi':
                    $uploaddir = __DIR__ . '/../assets/img/magi/';
                    if ($_FILES['imgmagi']['name'] != "") {
                        $my_file_tmp_name = $_FILES['imgmagi']['tmp_name'];
                        $my_file_error_flag = $_FILES['imgmagi']['error'];
                        $my_file_destination_name = "file" . date('ydmhms') . ".jpg";

                        if ($my_file_error_flag == 0) {
                            if (move_uploaded_file($my_file_tmp_name, $uploaddir.''.$my_file_destination_name)) {
                            } else {
                            }
                        }
                    }
                    $db->dbQueryResourceReturn("insert into `content` (`name`, `title`, `text`, `img`, `dop_text`, `main_title`, `date_changed`) 
                                    VALUES ('img','','','" . $my_file_destination_name . "', '', '', '" . date('Y-m-d') . "');");
                    header('Location: /admin');
                    break;
                case 'magidelete':
                    $db->dbQueryResourceReturn("update `content` set `img`='' where `content_id`='" . $_POST['delete'] . "';");
                    $filename = __DIR__ . '/../assets/img/magi/' . $_POST['img'];
                    unlink($filename);
                    header('Location: /admin');
                    break;
                case 'imgmagizamena':
                    if ($_FILES['imgmagizamena']['name'] != "") {
                        $my_file_tmp_name = $_FILES['imgmagizamena']['tmp_name'];
                        $my_file_error_flag = $_FILES['imgmagizamena']['error'];
                        $my_file_destination_name = "file" . date('ydmhms') . ".jpg";

                        if ($my_file_error_flag < 1) {
                            if (move_uploaded_file($my_file_tmp_name, $uploaddir.''.$my_file_destination_name)) {
                            } else {
                            }
                        }
                    }
                    $oldImg = $db->dbQueryArryReturn("select * from `content` WHERE `content_id`='" . $_POST['content_id'] . "'");
                    unlink(__DIR__ . '/../assets/img/magi/' . $oldImg[0]->img);
                    $db->dbQueryResourceReturn("update `content` set `img`='" . $my_file_destination_name . "' where `content_id`='" . $_POST['content_id'] . "'");
                    header('Location: /admin');
                    break;
            }

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
}