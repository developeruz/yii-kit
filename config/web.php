<?php

//Dotenv::load('', '.env');

$params = require(__DIR__ . '/params.php');

Yii::setAlias('@uploads', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'uploads');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => require(__DIR__ . '/components.php'),
    'params' => $params,
    'modules' => require(__DIR__ . '/modules.php'),
    'as AppBehavior' => [
        'class' => 'app\components\AppBehavior',
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
//         uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
