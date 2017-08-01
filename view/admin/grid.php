<?php
/**
 * Created by PhpStorm.
 * User: koshpaevsv
 * Date: 05.07.17
 * Time: 20:18
 */
require(__DIR__ . '/../../model/db.php');
$db = \model\DB::getInstance();
$allContent = $db->getAllData();
?>
<!DOCTYPE html>
<html lang="rus">
<head>
    <meta charset="UTF-8">
    <title>АстроЛандра</title>
    <script
            src="http://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous">
    </script>
    <script src="/assets/js/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="description" content="Человек – это тоже модель Вселенной, поэтому всегда и для всего важно уметь выбрать время! Как говорится «каждый выбирает для себя»: профессию, религию, дорогу и …советчика.">
</head>
<div>
    <div id="popup">ЗАГРУЗКА...</div>
<div class="admin-panel">
    <div class="block">
        <span>Сайт включен</span><input type="checkbox" <?=
            $db->allConfig[1]['config_status'] ?  'checked' : "";
        ?> onchange="site(this);">
    </div>
    <div class="block">
        <h3>Шапка/футер сайта:</h3>
        <form action="/admin/header" id="main" method="post" name="main_title">
            Название страницы<input name="2" type="text" value="<?= $allContent[2]['text'] ?>"><br>
            Телефон 1<input name="3" type="text" value="<?= $allContent[3]['text'] ?>"><br>
            Телефон 2<input name="4" type="text" value="<?= $allContent[4]['text'] ?>"><br>
            Адрес:<input name="5" type="text" value="<?= $allContent[5]['text'] ?>"><br>
            Email:<input name="6" type="text" value="<?= $allContent[6]['text'] ?>"><br>
            VK:<input name="7" type="text" value="<?= $allContent[7]['text'] ?>"><br>
            INSTAGRAMM:<input name="8" type="text" value="<?= $allContent[8]['text'] ?>"><br>
            Сообщение в попапе:<textarea name="9" type="text" cl><?= $allContent[9]['text'] ?></textarea><br>
            Названия меню 1:<input name="10" type="text" value="<?= $allContent[10]['text'] ?>"><br>
            Названия меню 2:<input name="11" type="text" value="<?= $allContent[11]['text'] ?>"><br>
            Названия меню 3:<input name="12" type="text" value="<?= $allContent[12]['text'] ?>"><br>
            Названия меню 4:<input name="13" type="text" value="<?= $allContent[13]['text'] ?>"><br>
            <input type="submit" class="" value="Сохранить">
        </form>
    </div>
    <div class="block">
        <h3>Слайдер</h3>
        <form enctype="multipart/form-data" action="/admin/slider" method="POST" class="block">
            Отправить этот файл: <input name="slider" type="file" accept="image/*" />
            <input type="submit" value="Сохранить файл" />
        </form>
            <table>
                <thead></thead>
            <?php
            $dir = __DIR__ . '/../../assets/img/slider';
            $f = scandir($dir);
            $arr = [];
            foreach ($f as $file){
                $html = "";
                if($file != '..' && $file != '.') {
                    $row = $db->getRowByImg($file);
                    if($row) {
                        $html .= '<tr>';
                        $html .= '<td><img src="/assets/img/slider/' . $file . '" width="160" height="80" /></td>';
                        $html .= '<td><form method="post" action="/admin/slider/text"><textarea type="text" name="' . $row['content_id'] . '">' . $row['text'] . '</textarea><input type="submit" value="Сохранить"><script>CKEDITOR.replace( "' . $row['content_id'] . '" );</script></form>';
                        $html .= '<td><form method="post" action="/admin/slider/delete"><input name="delete" type="hidden" value="' . $row['content_id'] . '"><input name="img" type="hidden" value="' . $row['img'] . '"><input type="submit" value="Удалить"></form>';
                        $html .= '<td><button id="id'.$row['content_id'].'" onclick="downs(this)">Вверх('.$row['order'].')</button><button id="id'.$row['content_id'].'" onclick="ups(this)">Вниз('.$row['order'].')</button></td>';
                        $html .= '</tr>';
                        $arr[$row['order']] = $html;
                    }
                }
            }
            ksort($arr);
            echo implode($arr);
            ?>
            </table>
    </div>
    <div class="block">
    <h3>Описание</h3>
    <form action="/admin/commmon" id="common" method="post" name="common">
        Заголовок:<input name="title" type="text" value="<?= $allContent[29]['title']; ?>"><br>
        Текст:<textarea name="text" type="text" multiple="true" style="width: 200px;background-color: white"><?= $allContent[29]['text']; ?></textarea><br>
        <script>
            CKEDITOR.replace( 'text' );
        </script>
        <input type="submit" class="" value="Сохранить">
    </form>
    </div>
    <h3>Консультанты</h3>

    <div class="block">
        <h3>Главный консультант</Главны></h3>
        <form enctype="multipart/form-data" action="/admin/mag" method="POST" class="block">
            Заменить фото: <input name="mag" type="file" accept="image/*" />
            <input type="submit" value="Сохранить файл" />
        </form>
        <table>
            <thead></thead>
            <?php
            $dir = __DIR__ . '/../../assets/img/magi';
            $f = scandir($dir);
            foreach ($f as $file){
                if($file != '..' && $file != '.') {
                    $row = $db->getRowByImg($file);
                    if($row['content_id'] == 30) {
                        echo '<tr style="background-color: #869791">';
                        echo '<td><img src="/assets/img/magi/' . $file . '" width="400" height="250" /></td>';
                        echo '<td><form method="post" action="/admin/mag/text"><textarea type="text" name="main_mag">' . $row['text'] . '</textarea><input type="submit" value="Сохранить"></form>';
                        echo '<script>CKEDITOR.replace( \'main_mag\' );</script></tr>';
                    }
                }
            }
            ?>
        </table>
    </div>


    <div class="block">
        <h3>Консультанты</h3>
        <form enctype="multipart/form-data" action="/admin/imgmagi" method="POST" class="block">
            Новое фото: <input name="imgmagi" type="file" accept="image/*" />
            <input type="submit" value="Сохранить файл" />
        </form>
        <table>
            <thead></thead>
            <?php
            $dir = __DIR__ . '/../../assets/img/magi';
            $f = scandir($dir);
            $arr = [];
            foreach ($f as $file){
                $html = "";
                if($file != '..' && $file != '.') {
                    $row = $db->getRowByImg($file);
                    if($row && $row['content_id'] != 30) {
                        $html .= '<tr>';
                        $html .= '<td><img src="/assets/img/magi/' . $file . '" width="160" height="80" />';
                        $html .= '<form enctype="multipart/form-data" action="/admin/imgmagizamena" method="POST" class="block">
                                <input type="hidden" name="content_id" value="' . $row['content_id'] . '">
                                Заменить фото: <input name="imgmagizamena" type="file" accept="image/*" />
                                <input type="submit" value="Сохранить файл" />
                                </form></td>';
                        $html .= '<td><form method="post" action="/admin/magi/text"><input type="text" name="magititle" value="' . $row['title'] . '"><textarea type="text" name="' . $row['content_id'] . '">' . $row['text'] . '</textarea><input type="submit" value="Сохранить"></form>';
                        $html .= '<td><form method="post" action="/admin/magi/delete"><input name="delete" type="hidden" value="' . $row['content_id'] . '"><input name="img" type="hidden" value="' . $row['img'] . '"><input type="submit" value="Удалить"></form>';
                        $html .= '<td><button id="id'.$row['content_id'].'" onclick="down(this)">Вверх('.$row['order'].')</button><button id="id'.$row['content_id'].'" onclick="up(this)">Вниз('.$row['order'].')</button></td>';
                        $html .= '<script>CKEDITOR.replace( "' . $row['content_id'] . '" );</script></tr>';
                    }
                    $arr[$row['order']] = $html;
                }
            }
            ksort($arr);
            echo implode($arr);
            ?>
        </table>
    </div>
    <div class="block uslugi">
        <h3>Услуги</h3>
        <form action="/admin/imguslugiaddmaintitle" method="post" class="block">
            <input type="text" value="<?= $allContent[49]['title'] ?>" name="title">
            <textarea name="imguslugiaddmaintitle"><?= $allContent[49]['text'] ?></textarea>
            <script>CKEDITOR.replace('imguslugiaddmaintitle');</script>
            <input type="submit" value="Сохранить" />
        </form>
        <form enctype="multipart/form-data" action="/admin/imguslugiadd" method="POST" class="block">
            Новое фото: <input name="imguslugiadd" type="file" accept="image/*" />
            <input type="submit" value="Сохранить файл" />
        </form>
        <table>
            <thead></thead>
            <?php
            $dir = __DIR__ . '/../../assets/img/uslugi';
            $f = scandir($dir);
            $arr = [];
            foreach ($f as $file){
                $html = "";
                if($file != '..' && $file != '.') {
                    $row = $db->getRowByImg($file);
                    if($row) {
                        $html .= '<tr>';
                        $html .= '<td><img src="/assets/img/uslugi/' . $file . '" width="160" height="80" />';
                        $html .= '<form enctype="multipart/form-data" action="/admin/imgzamenauslugi" method="POST" class="block">
                                <input type="hidden" name="content_id" value="' . $row['content_id'] . '">
                                Заменить фото: <input name="imgmagizamenauslugi" type="file" accept="image/*" />
                                <input type="submit" value="Сохранить файл" />
                                </form></td>';
                        $html .= '<td><form method="post" action="/admin/uslugi/text"><input type="text" name="uslugititle" value="' . $row['title'] . '"><input type="hidden" name="content_id" value="'. $row['content_id'] .'"><textarea type="text" name="textuslugi'.$row['content_id'].'">' . $row['text'] . '</textarea><input type="submit" value="Сохранить"></form>';
                        $html .= '<td><form method="post" action="/admin/uslugi/delete"><input name="delete" type="hidden" value="' . $row['content_id'] . '"><input name="img" type="hidden" value="' . $row['img'] . '"><input type="submit" value="Удалить"></form>';
                        $html .= '<td><button id="id'.$row['content_id'].'" onclick="downU(this)">Вверх('.$row['order'].')</button><button id="id'.$row['content_id'].'" onclick="upU(this)">Вниз('.$row['order'].')</button></td>';
                        $html .= "<script>CKEDITOR.replace('textuslugi".$row['content_id']."');</script></tr>";
                    }
                    $arr[$row['order']] = $html;
                }
            }
            ksort($arr);
            echo implode($arr);
            ?>
        </table>
    </div>
    <div class="block">
    <h3>Отзывы</h3>
        <form action="/admin/otziv" method="post" class="block">
        <?php
        $arr=[];
        foreach ($allContent as $otziv) {
            $html = "";
            if($otziv['name'] == 'otziv') {
                $html .= '<textarea name="otziv' . $otziv['content_id'] . '">';
                $html .= $otziv['text'];
                $html .= "</textarea><script>CKEDITOR.replace('otziv".$otziv['content_id']."');</script>";
                $html .= "<input type='button' value='Удалить отзыв' name='" . $otziv['content_id']. "' onclick='del(this)'>";
                $html .= '<td><button id="id'.$otziv['content_id'].'" onclick="downO(this)">Вверх('.$otziv['order'].')</button><button id="id'.$otziv['content_id'].'" onclick="upO(this)">Вниз('.$otziv['order'].')</button></td>';
                $arr[$otziv['order']] = $html;
            }
        }
        ksort($arr);
        echo implode($arr);
        ?>
            <br><input type="submit" value="Сохранить все изменения" />
        </form>
        <form action="/admin/otzivnew" method="post" class="block">
            <textarea type="text" name="otzivnew"></textarea>
            <script>CKEDITOR.replace('otzivnew');</script>
            <input type="submit" value="Сохранить новый отзыв" />
        </form>
    </div>

    <p align="center">&nbsp;</p>
    <p align="center"><a href="/logout" style="color: #A9A9A9;cursor: pointer;">ВЫЙТИ</a></p>
</div>

    <script src="/assets/js/admin.js" type="text/javascript"></script>