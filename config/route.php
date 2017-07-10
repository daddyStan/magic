<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 04.07.2017
 * Time: 21:01
 */

$actualRoute = $_SERVER["REQUEST_URI"];

$allRouts = [
    '/' => 'view/zahlyshka.php',
    'error' => 'view/error.php',
    '/admin' => 'view/admin/index.php',
    '/zag' => 'view/index.php',
    '/logout' => [
        'controller' => 'logout'
    ],
    '/admin/header' => [
        'controller' => 'changeHeader'
    ],
    '/admin/slider' => [
        'controller' => 'imageloader'
    ],
    '/admin/slider/text' => [
        'controller' => 'textloader'
    ],
    '/admin/slider/delete' => [
        'controller' => 'sliderdeleter'
    ],
    '/admin/commmon' => [
        'controller' => 'common'
    ],
    '/admin/mag' => [
        'controller' => 'magi',
        'params' =>[
            'main_mag' => 'img'
        ]
    ],
    '/admin/mag/text' => [
        'controller' => 'magi',
        'params' => [
            'main_mag' => 'text'
        ]
    ],
    '/admin/magi/text' => [
        'controller' => 'magi',
        'params' => [
            'main_mag' => 'magitext'
        ]
    ],
    '/admin/imgmagi' => [
        'controller' => 'magi',
        'params' => [
            'main_mag' => 'imgmagi'
        ]
    ],
    '/admin/magi/delete' => [
        'controller' => 'magi',
        'params' => [
            'main_mag' => 'magidelete'
        ]
    ],
    '/admin/imgmagizamena' => [
        'controller' => 'magi',
        'params' => [
            'main_mag' => 'imgmagizamena'
        ]
    ],
    '/admin/imgzamenauslugi' => [
        'controller' => 'uslugi',
        'params' => [
            'action' => 'imgzamenauslugi'
        ]
    ],
    '/admin/uslugi/text' => [
        'controller' => 'uslugi',
        'params' => [
            'action' => 'uslugitext'
        ]
    ],
    '/admin/uslugi/delete' => [
        'controller' => 'uslugi',
        'params' => [
            'action' => 'uslugidelete'
        ]
    ],
    '/admin/imguslugiadd' => [
        'controller' => 'uslugi',
        'params' => [
            'action' => 'add'
        ]
    ],
    '/admin/imguslugiaddmaintitle' => [
        'controller' => 'uslugi',
        'params' => [
            'action' => 'mainTitle'
        ]
    ]
];