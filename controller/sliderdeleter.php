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
        $this->deleteOrder($_POST['delete'],$db);
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

    public function deleteOrder($id,$db) {
        $dir = __DIR__ . '/../assets/img/slider';
        $f = scandir($dir);
        $arr = [];
        foreach ($f as $file){
            if($file != '..' && $file != '.') {
                $row = $db->getRowByImg($file);
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
            $db->dbQueryResourceReturn("update `content` set `order`='" . $value . "'  where `content_id`='" . $key. "';");
        }
    }
}