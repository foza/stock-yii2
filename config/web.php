<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','languagepicker'],
    'language' => 'ru-RU', // или en-US
    'components' => [
        'user' => [
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',
     
            // Comment this if you don't want to record user logins
            'on afterLogin' => function($event) {
                    \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
                }
        ],
        'urlManager' => [
            'baseUrl'=>$baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '<member:\w+>/<index:\w+>'=>'<member>/<index>',
            ],
        ],
        /*'urlManager' => [
            //'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
            // ...
        ],*/

        'languagepicker' => [
            'class' => 'lajax\languagepicker\Component',
            'languages' => ['en'=>'English', 'ru'=>'Russian','uz'=>'Uzbek'],                  // Перечень доступных языков для переключения (icons only)
            'cookieName' => 'language',                         // Имя cookie.
            'expireDays' => 64,                                 // Время устаревания cookie в днях.
     
        ],
        /*'i18n' => [
            'translations' => [
                'models*' => [ // заголовки для моделей
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // путь к файлам перевода
                    'sourceLanguage' => 'ru', // Язык с которого переводиться (данный язык использован в текстах сообщений).
 
                ],
                'msg*' => [ // другие заголовки
                    'class' => 'yii\i18n\PhpMessageSource', 
                    'basePath' => '@app/messages',// путь к файлам перевода
                    'sourceLanguage' => 'ru', // // Язык с которого переводиться (данный язык использован в текстах сообщений).
 
                ],                
            ],
        ],*/ 
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'lgughJG:hF%^$JKBHBGFhuigtduhasd',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /*'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],*/
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        YII_ENV_DEV ? '/js/jquery.js' : '/js/jquery.min.js'
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        YII_ENV_DEV ? '/css/bootstrap.css' : '/css/bootstrap.min.css',
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        YII_ENV_DEV ? '/js/bootstrap.js' : '/js/bootstrap.min.js',
                    ]
                ]
            ],
        ],
    ],
    'modules'=>[
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',
            'registrationFormClass' => 'webvimark\modules\UserManagement\models\RegistrationFormWithProfile',
            // Here you can set your handler to change layout for any controller or action
            // Tip: you can use this event in any module
            'on beforeAction'=>function(yii\base\ActionEvent $event) {
                    if ( $event->action->uniqueId == 'user-management/auth/login' )
                    {
                        $event->action->controller->layout = 'loginLayout.php';
                    };
                },
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}
return $config;
