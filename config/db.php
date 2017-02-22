<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => env('APP_DB_DSN', 'mysql:host=localhost;dbname=mydbname'),
    'username' => env('APP_DB_USER', 'dbuser'),
    'password' => env('APP_DB_PASSWORD','dbpassword'),
    'charset' => env('APP_DB_ENCODING', 'utf8'),
];
