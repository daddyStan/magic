<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 28.07.2017
 * Time: 1:36
 */

require ('root.php');

class sendmail extends root
{
    public function sendmail() {
        $today = date("d.m.y - h.m.s ");
        $message = "<head></head><body><style>p, h4, ul{font-family: pt-sans, sans-serif;line-height: 20px;font-size: 17px;font-weight: 400;}</style><h4 style='font-weight: 700;'></h4>";
        $message .= "<p>Сообщение с сайта http://www.astrolandra.ru/ от  ".$today."</p>";
        $message .= "<p>Имя: ".$_POST['name']."</p>";
        $message .= "<p>Email: ".$_POST['email']."</p>";
        $message .= "<p>Сообщение: ".$_POST['feedback']."</p>";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: astrolandra <info@astrolandra.ru>\r\n";
        $sendMail = mail("astrolandra.ru@gmail.com,sts.ko@mail.ru", "Сообщение с сайта от  ".$today."", $message, $headers);

        if($sendMail) {
            echo "good";
        } else {
            echo "error";
        }
    }
}