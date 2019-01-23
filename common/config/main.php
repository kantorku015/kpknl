<?php
use kartik\grid\GridView;
use kartik\mpdf\Pdf;
return [
    'controllerMap' => [
        'file' => 'mdm\\upload\\FileController', // use to show or download file
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' =>[
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '',
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ],
                'kvgrid' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ],
            ],
        ],
        'pdf' => [
                'class' => Pdf::classname(),
                'format' => Pdf::FORMAT_A4,
                'orientation' => Pdf::ORIENT_PORTRAIT,
                'destination' => Pdf::DEST_BROWSER,
                // refer settings section for all configuration options
            // ]
        ],
        'authManager' => [
            // 'class' => 'yii\rbac\PhpManager',
            'class' => 'yii\rbac\DbManager',
            'defaultRoles'=>['guest'],
        ],
    ],
    'modules' => [
       'gridview' =>  [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            'downloadAction' => 'gridview/export/download',
            'i18n' => [],
            // 'floatHeader'=>true,
            // 'floatHeaderOptions'=>['scrollingTop'=>'50'],
        ],
        'gridviewKrajee' =>  [
            'class' => '\kartik\grid\Module',
            // your other grid module settings
        ],
            // 'exportConversions ' => 'Active',
    ],
];
