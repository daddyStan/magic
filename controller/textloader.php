<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 09.07.2017
 * Time: 18:05
 */

require ('root.php');

class textloader extends root
{
    public function __construct()
    {
        foreach ($_POST as $key => $value) {
            require (__DIR__ . '/../model/db.php');
            $db = model\DB::getInstance();
            $db->dbQueryResourceReturn("update `content` set `text`='" . $value . "' where `content_id`='" . $key . "';");
        }

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