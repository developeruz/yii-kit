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
];
