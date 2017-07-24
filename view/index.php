<?php
require(__DIR__ . '/../model/db.php');
$db = \model\DB::getInstance();
$allContent = $db->getAllData();
?>
<!DOCTYPE html>
<html lang="rus">
<head>
    <meta charset="UTF-8">
    <title><?= $allContent[2]['text'] ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="description" content="Человек – это тоже модель Вселенной, поэтому всегда и для всего важно уметь выбрать время! Как говорится «каждый выбирает для себя»: профессию, религию, дорогу и …советчика.">
</head>
<body>
<section>
    <header class="header">
        <div class="header-top">
            <div class="wrap">
                <div class="header-wrap">
                    <div class="logo">
                        <img src="../assets/img/logo_bot.png" alt="АстроЛандра" class="logo-img bot" />
                        <img src="../assets/img/logo_top.png" alt="АстроЛандра" class="logo-img top" />
                        <span class="logo-text"><?= $allContent[2]['text'] ?></span>
                    </div>
                    <div class="social">
                        <a class="social-btn" href="<?= $allContent[7]['text'] ?>" target="_blank"><img src="../assets/img/vk_icon.svg" alt="Мы в Вконтакте"></a>
                        <a class="social-btn" href="<?= $allContent[8]['text'] ?>" target="_blank"><img src="../assets/img/inst_icon.svg" alt="Мы в Инстаграмм"></a>
                        <a class="social-btn popup-open" href="javascript:void(0);"><img src="../assets/img/ask.svg" alt="Обратная связь"></a>
                    </div>
                    <div class="address-block">
                        <a href="tel:+7(921)900-8-123" class="tel"><?= $allContent[3]['text'] ?></a>
                        <a href="tel:8(812)347-67-07" class="tel"><?= $allContent[4]['text'] ?></a>
                        <span class="address"><?= $allContent[5]['text'] ?></span>
                        <a href="email:email@email.com" class="email"><?= $allContent[6]['text'] ?></a>
                    </div>
                </div>
            </div>
        </div>
        <nav class="nav">
            <div class="wrap">
                <ul class="nav-list">
                    <li class="nav-list_item"><a class="nav-list_item_link" href="#consultants"><?= $allContent[10]['text'] ?></a></li>
                    <li class="nav-list_item"><a class="nav-list_item_link" href="#price"><?= $allContent[11]['text'] ?></a></li>
                    <li class="nav-list_item"><a class="nav-list_item_link" href="#reviews"><?= $allContent[12]['text'] ?></a></li>
                    <li class="nav-list_item"><a class="nav-list_item_link" href="#contacts"><?= $allContent[13]['text'] ?></a></li>
                </ul>
            </div>
        </nav>
        <div class="owl-carousel">
            <?php
                $dir = __DIR__ . '/../assets/img/slider';
                $f = scandir($dir);
                foreach ($f as $file){
                    if($file != '..' && $file != '.') {
                        $row = $db->getRowByImg($file);
                        if($row) {
                            echo '<div class="owl-carousel_item">';
                            echo '<p>' . $row['text'] . '</p>';
                            echo '<img src="/assets/img/slider/' . $file . '" width="160" height="80" />';
                            echo '</div>';
                        }
                    }
                }

            ?>
        </div>
    </header>
</section>
<section>
    <div class="about">
        <div class="wrap">
            <h1><?= $allContent[29]['title'] ?></h1>
            <?= $allContent[29]['text'] ?>
        </div>
    </div>
</section>
<section>
    <div class="consultants">
        <a id="consultants"></a>
        <div class="wrap">
            <h2>Консультанты</h2>
            <div class="consultants-wrap">
                <div class="consultant-item main-consultants">
                    <img src="../assets/img/magi/<?= $allContent[30]['img'] ?>" alt="" />
                    <div class="consultant-desc">
                        <h3><?= $allContent[30]['title'] ?></h3>
                        <?= $allContent[30]['text'] ?>
                    </div>
                </div>
                <?php
                $dir = __DIR__ . '/../assets/img/magi';
                $f = scandir($dir);
                foreach ($f as $file){
                    if($file != '..' && $file != '.') {
                        $row = $db->getRowByImg($file);
                        if($row && $row['content_id'] != 30) {
                            echo '<div class="consultant-item">';
                            echo '<img src="../assets/img/magi/' . $file . '" alt="" />';
                            echo '<div class="consultant-desc">';
                            echo '<h3>' . $row['title'] . '</h3>';
                            echo $row['text'];
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                }

                ?>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="price" id="price">
        <div class="wrap">
            <h2><?= $allContent[49]['title'] ?> <span><?= $allContent[49]['text'] ?></span></h2>
            <div class="price-list">
                <?php
                $dir = __DIR__ . '/../assets/img/uslugi';
                $f = scandir($dir);
                foreach ($f as $file){
                    if($file != '..' && $file != '.') {
                        $row = $db->getRowByImg($file);
                        if($row) {

                            echo '<div class="price-item"><div class="price-img">' .
                            '<img src="../assets/img/uslugi/' . $row['img'] . '" alt=""></div>' .
                            '<div class="price-desc">' . $row['title'] . '<div class="price-hover">' .
                            $row['text'] . '</div></div></div>';

                         }
                    }
                }
                ?>
        </div>
    </div>
</section>
<section>
    <div class="reviews">
        <a id="reviews"></a>
        <div class="wrap">
            <h2>Отзывы</h2>
            <div class="reviews-wrap">
                <?php
                    foreach ($allContent as $otziv) {
                        if($otziv['name'] == 'otziv') {
                            echo ' <div class="review-item">';
                            echo $otziv['text'];
                            echo "</div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <h2>Как нас найти</h2>
</section>
<section>
    <div class="map">
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A227e85437b201d46c42e94ecd8fe82af685768d08299715c86bf76fb1c5262ae&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=false"></script>
    </div>
</section>
<section>
    <div class="footer">
        <a id="contacts"></a>
        <div class="wrap">
            <div class="footer-wrap">
                <div class="logo">
                    <img src="../assets/img/logo_bot.png" alt="АстроЛандра" class="logo-img bot" />
                    <img src="../assets/img/logo_top.png" alt="АстроЛандра" class="logo-img top" />
                    <span class="logo-text"><?= $allContent[2]['text'] ?></span>
                </div>
                <div class="social">
                    <a class="social-btn" href="<?= $allContent[7]['text'] ?>" target="_blank"><img src="../assets/img/vk_icon.svg" alt="Мы в Вконтакте"></a>
                    <a class="social-btn" href="<?= $allContent[8]['text'] ?>" target="_blank"><img src="../assets/img/inst_icon.svg" alt="Мы в Инстаграмм"></a>
                    <a class="social-btn popup-open" href="javascript:void(0);"><img src="../assets/img/ask.svg" alt="Обратная связь"></a>
                </div>
                <div class="address-block">
                    <a href="tel:+7(921)900-8-123" class="tel"><?= $allContent[3]['text'] ?></a>
                    <a href="tel:8(812)347-67-07" class="tel"><?= $allContent[4]['text'] ?></a>
                    <span class="address"><?= $allContent[5]['text'] ?></span>
                    <a href="email:email@email.com" class="email"><?= $allContent[6]['text'] ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="feedback">
    <div class="blackout"></div>
    <form id="feedback-popup" action="">
        <p><?= $allContent[9]['text'] ?></p>
        <span class="close">&times;</span>
        <input id="name" type="text" placeholder="Имя" />
        <input id="email" type="text" placeholder="E-mail" />
        <textarea name="feedback" placeholder="Сообщение"></textarea>
        <button id="send-form">Отправить</button>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../assets/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="../assets/js/main.js" type="text/javascript"></script>
</body>
</html>