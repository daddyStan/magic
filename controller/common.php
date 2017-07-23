<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 09.07.2017
 * Time: 20:43
 */

require ('root.php');

class common extends root
{
    public function __construct()
    {
        require (__DIR__ . '/../model/db.php');
        $db = model\DB::getInstance();
        $db->dbQueryResourceReturn("update `content` set `text`='" . $_POST['text'] . "', `title`='" . $_POST['title'] . "', `date_changed`='" . date('Y-m-d') . "' where `content_id`='29';");
        /**
         * @todo Проверить не упало ли чего изза коммент-строчек, если всё ок - удалить
         */
//        $filename = __DIR__ . '/../assets/img/slider/' . $_POST['img'];
//        unlink($filename);
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