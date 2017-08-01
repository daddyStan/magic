<?php

$filename = __DIR__ . '/cache.dat';

if (file_exists($filename)) {
    $html = file_get_contents($filename);
    echo $html;
    exit();
} else {
    ob_start();
}

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
        <meta name="description"
              content="Человек – это тоже модель Вселенной, поэтому всегда и для всего важно уметь выбрать время! Как говорится «каждый выбирает для себя»: профессию, религию, дорогу и …советчика.">
    </head>
    <body>
    <section>
        <header class="header">
            <div class="header-top">
                <div class="wrap">
                    <div class="header-wrap">
                        <div class="logo">
                            <img src="../assets/img/logo_bot.png" alt="АстроЛандра" class="logo-img bot"/>
                            <img src="../assets/img/logo_top.png" alt="АстроЛандра" class="logo-img top"/>
                            <span class="logo-text"><?= $allContent[2]['text'] ?></span>
                        </div>
                        <div class="social">
                            <a class="social-btn" href="<?= $allContent[7]['text'] ?>" target="_blank"><img
                                        src="../assets/img/vk_icon.svg" alt="Мы в Вконтакте"></a>
                            <a class="social-btn" href="<?= $allContent[8]['text'] ?>" target="_blank"><img
                                        src="../assets/img/inst_icon.svg" alt="Мы в Инстаграмм"></a>
                            <a class="social-btn popup-open" href="javascript:void(0);"><img src="../assets/img/ask.svg"
                                                                                             alt="Обратная связь"></a>
                        </div>
                        <div class="address-block">
                            <a href="tel:+7(921)900-8-123" class="tel"><?= $allContent[3]['text'] ?></a>
                            <a href="tel:8(812)347-67-07" class="tel"><?= $allContent[4]['text'] ?></a>
                            <span class="address"><?= $allContent[5]['text'] ?></span>
                            <a href="mailto:<?= $allContent[6]['text'] ?>" class="email"><?= $allContent[6]['text'] ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="nav">
                <div class="wrap">
                    <ul class="nav-list">
                        <li class="nav-list_item"><a class="nav-list_item_link"
                                                     href="#consultants"><?= $allContent[10]['text'] ?></a></li>
                        <li class="nav-list_item"><a class="nav-list_item_link"
                                                     href="#price"><?= $allContent[11]['text'] ?></a></li>
                        <li class="nav-list_item"><a class="nav-list_item_link"
                                                     href="#reviews"><?= $allContent[12]['text'] ?></a></li>
                        <li class="nav-list_item"><a class="nav-list_item_link"
                                                     href="#contacts"><?= $allContent[13]['text'] ?></a></li>
                    </ul>
                </div>
            </nav>
            <div class="owl-carousel">
                <?php
                $dir = __DIR__ . '/../assets/img/slider';
                $f = scandir($dir);
                $arr = [];
                foreach ($f as $file) {
                    $html = "";
                    if ($file != '..' && $file != '.') {
                        $row = $db->getRowByImg($file);
                        if ($row) {
                            $html .= '<div class="owl-carousel_item">';
                            $html .= '<div><p>' . $row['text'] . '</p></div>';
                            $html .= '<img src="/assets/img/slider/' . $file . '" width="160" height="80" />';
                            $html .= '</div>';
                            $arr[$row['order']] = $html;
                        }
                    }
                }
                ksort($arr);
                echo implode($arr);
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
                        <img src="../assets/img/magi/<?= $allContent[30]['img'] ?>" alt=""/>
                        <div class="consultant-desc">
                            <h3><?= $allContent[30]['title'] ?></h3>
                            <?= $allContent[30]['text'] ?>
                        </div>
                    </div>
                    <?php
                    $dir = __DIR__ . '/../assets/img/magi';
                    $f = scandir($dir);
                    $arr = [];
                    foreach ($f as $file) {
                        $html = "";
                        if ($file != '..' && $file != '.') {
                            $row = $db->getRowByImg($file);
                            if ($row && $row['content_id'] != 30) {
                                $html .= '<div class="consultant-item">';
                                $html .= '<img src="../assets/img/magi/' . $file . '" alt="" />';
                                $html .= '<div class="consultant-desc">';
                                $html .= '<h3>' . $row['title'] . '</h3>';
                                $html .= $row['text'];
                                $html .= '</div>';
                                $html .= '</div>';
                            }
                            $arr[$row['order']] = $html;
                        }
                    }
                    ksort($arr);
                    echo implode($arr);
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
                    $arr = [];
                    foreach ($f as $file) {
                        $html = "";
                        if ($file != '..' && $file != '.') {
                            $row = $db->getRowByImg($file);
                            if ($row) {

                                $html .= '<div class="price-item"><div class="price-img">' .
                                    '<img src="../assets/img/uslugi/' . $row['img'] . '" alt=""></div>' .
                                    '<div class="price-desc">' . $row['title'] . '<div class="price-hover">' .
                                    $row['text'] . '</div></div></div>';

                            }
                            $arr[$row['order']] = $html;
                        }
                    }
                    ksort($arr);
                    echo implode($arr);
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
                    $arr = [];
                    foreach ($allContent as $otziv) {
                        $html = "";
                        if ($otziv['name'] == 'otziv') {
                            $html .= ' <div class="review-item">';
                            $html .= $otziv['text'];
                            $html .= "</div>";
                            $arr[$otziv['order']] = $html;
                        }
                    }
                    ksort($arr);
                    echo implode($arr);
                    ?>
                </div>
            </div>
        </div>
        <h2>Как нас найти</h2>
    </section>
    <section>
        <div class="map">
            <script type="text/javascript" charset="utf-8" async
                    src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A227e85437b201d46c42e94ecd8fe82af685768d08299715c86bf76fb1c5262ae&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=false"></script>
        </div>
    </section>
    <section>
        <div class="footer">
            <a id="contacts"></a>
            <div class="wrap">
                <div class="footer-wrap">
                    <div class="logo">
                        <img src="../assets/img/logo_bot.png" alt="АстроЛандра" class="logo-img bot"/>
                        <img src="../assets/img/logo_top.png" alt="АстроЛандра" class="logo-img top"/>
                        <span class="logo-text"><?= $allContent[2]['text'] ?></span>
                    </div>
                    <div class="social">
                        <a class="social-btn" href="<?= $allContent[7]['text'] ?>" target="_blank"><img
                                    src="../assets/img/vk_icon.svg" alt="Мы в Вконтакте"></a>
                        <a class="social-btn" href="<?= $allContent[8]['text'] ?>" target="_blank"><img
                                    src="../assets/img/inst_icon.svg" alt="Мы в Инстаграмм"></a>
                        <a class="social-btn popup-open" href="javascript:void(0);"><img src="../assets/img/ask.svg"
                                                                                         alt="Обратная связь"></a>
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
        <div id="feedback-popup" action="">
            <p><?= $allContent[9]['text'] ?></p>
            <span class="close">&times;</span>
            <input id="name" type="text" placeholder="Имя" required/>
            <input id="email" type="text" placeholder="E-mail" required/>
            <textarea id="feedback" placeholder="Сообщение" required></textarea>
            <button id="send-form" onclick="mail();return false;">Отправить</button>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js" type="text/javascript"></script>
    <script src="../assets/js/main.js" type="text/javascript"></script>
    <!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter45496635 = new Ya.Metrika({ id:45496635, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true, ut:"noindex" }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/45496635?ut=noindex" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
    </body>
    </html>
    <?

    $fp = fopen($filename, "a");
    $str = ob_get_contents();
    ob_end_clean();
    $write = fwrite($fp, $str);
    fclose($fp);
    echo $str;
?>