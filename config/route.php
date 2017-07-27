<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 04.07.2017
 * Time: 21:01
 */

$actualRoute = $_SERVER["REQUEST_URI"];

$allRouts = [
    '/' => DB ?  'view/index.php' : 'view/zahlyshka.php',
    'error' => 'view/error.php',
    '/admin' => 'view/admin/index.php',
    '/logout' => [
        'controller' => 'logout'
    ],
    '/sendmail' => [
        'controller' => 'sendmail'
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
    ],
    '/admin/otziv' => [
        'controller' => 'otziv'
    ],
    '/admin/otzivnew' => [
        'controller' => 'otziv',
        'params' => [
            'action' => 'text'
        ]
    ],
    '/admin/otzivdelete' => [
        'controller' => 'otziv',
        'params' => [
            'action' => 'delete'
        ]
    ],
    '/admin/otzivorderup' => [
        'controller' => 'otziv',
        'params' => [
            'action' => 'up'
        ]
    ],
    '/admin/otzivorderdown' => [
        'controller' => 'otziv',
        'params' => [
            'action' => 'down'
        ]
    ],
    '/admin/uslugiorderu' => [
        'controller' => 'uslugi',
        'params' => [
            'action' => 'up'
        ]
    ],
    '/admin/uslugiorderd' => [
        'controller' => 'uslugi',
        'params' => [
            'action' => 'down'
        ]
    ],
    '/admin/otzivorderu' => [
        'controller' => 'otziv',
        'params' => [
            'action' => 'upO'
        ]
    ],
    '/admin/otzivorderd' => [
        'controller' => 'otziv',
        'params' => [
            'action' => 'downO'
        ]
    ],
    '/admin/sliderup' => [
        'controller' => 'slider',
        'params' => [
            'action' => 'up'
        ]
    ],
    '/admin/sliderdown' => [
        'controller' => 'slider',
        'params' => [
            'action' => 'down'
        ]
    ],
    '/admin/config/siteon' => [
        'controller' => 'configController',
        'params' => [
            'action' => 'site'
        ]
    ],
];