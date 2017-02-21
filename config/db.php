<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => env('APP_DB_DSN', 'mysql:host=127.0.0.1;dbname=kit'),
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
];
