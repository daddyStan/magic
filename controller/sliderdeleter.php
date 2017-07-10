<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 09.07.2017
 * Time: 18:21
 */

require ('root.php');

class sliderdeleter extends root
{
    public function __construct()
    {
        require (__DIR__ . '/../model/db.php');
        $db = model\DB::getInstance();
        $db->dbQueryResourceReturn("update `content` set `img`='' where `content_id`='" . $_POST['delete'] . "';");
        $filename = __DIR__ . '/../assets/img/slider/' . $_POST['img'];
        unlink($filename);
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