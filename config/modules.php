<?php
return [
    'user' => [
        'class' => 'dektrium\user\Module',
        'modelMap' => [
            'User' => 'app\models\User',
        ],
        'controllerMap' => [
            'admin' => 'app\plugins\users\AdminController'
        ],
    ],
    'plugins' => [
        'class' => 'lo\plugins\Module',
        'pluginsDir'=>[
            '@lo/plugins/core',
            '@lo/shortcodes'
        ]
    ],
];
