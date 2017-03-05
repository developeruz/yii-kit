<?php
$dotenv = new Dotenv\Dotenv(dirname(__DIR__), file_exists(dirname(__DIR__). DIRECTORY_SEPARATOR . '.env.local') ? '.env.local' : '.env');
$dotenv->load();

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
        'class' => developeruz\yii_kit_core\behaviors\AppBehavior::className(),
    ],
    'as AccessBehavior' => [
        'class' => \developeruz\db_rbac\behaviors\AccessBehavior::className(),
        'protect' => ['admin', 'user'],
        'login_url' => '/user/security/login',
        'rules' => [
            'user/security' => [['actions' => ['login'], 'allow' => true ],
                                ['actions' => ['logout'], 'roles' => ['@'], 'allow' => true ]],
            'user/settings' => [['roles' => ['@'], 'allow' => true ]],
            'user/registration' => [['actions' => ['register'], 'allow' => true ]]
        ]
    ],
    'controllerMap' =>
    [
        'install' => [
            'class' => '\app\install\InstallController'
        ]
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
