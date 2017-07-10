<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 08.07.2017
 * Time: 20:52
 */
require ('root.php');

class changeHeader extends root
{
    public function __construct() {
        $post = $_POST;
        $validate = self::validate($post);
        if(!$validate) {
            header('Location: /admin');
        } else {
            require (__DIR__ . '\..\model\db.php');
            $db = \model\DB::getInstance();
            foreach ($post as $key => $value) {
                $str = "update `content` set `text`= '$value' WHERE `content_id`='$key'";
                $db->dbQueryResourceReturn($str);
//                var_dump($str);die;
            }
            header('Location: /admin');
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