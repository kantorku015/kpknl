<?php

use adminlte\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\KpknlStruktur;
$src = Url::to(['img/015a.png']);

if (Yii::$app->user->getIsGuest()) {
    // echo ucwords('Tamu');
}
else{

?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <!-- <img src="http://localhost/backend/web/img/avatar.png" class="img-circle" alt ="user image" /> -->
               <!-- <a href="<?=$src?>"> --><img src="<?=$src?>"></a>
                <!-- <span class="glyphicon glyphicon-user"></span> -->
            </div>
            <div class="pull-left info">
                <p>
                    <?php
                    if (Yii::$app->user->getIsGuest()) {
                            echo ucwords('Tamu');
                        }
                        else{
                            echo ucwords(Yii::$app->user->identity->username);
                          // echo Html::submitButton(
                          //   'Logout (' . Yii::$app->user->identity->username . ')',
                          //   ['class' => 'btn btn-link logout']);
                        }
                    ?>
                        
                    </p>
                <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php
        // Menu::widget(
        //         [
        //             'options' => ['class' => 'sidebar-menu'],
        //             'items' => [
        //                 ['label' => 'MENU', 'options' => ['class' => 'header']],
        //                 ['label' => 'Dashboard', 'icon' => 'fa fa-desktop', 
        //                     'url' => ['/'], 'active' => $this->context->route == 'site/index'
        //                 ],
        //                 [
        //                     'label' => 'PKN',
        //                     'icon' => 'fa fa-building',
        //                     'url' => '#',
        //                     'items' => [
        //                         [
        //                             'label' => 'Layanan 1',
        //                             'icon' => 'fa fa-building-o',
        //                             'url' => ['admin/pkn1'],
				    //                 'active' => $this->context->route == 'master1/index'
        //                         ],
        //                         [
        //                             'label' => 'Layanan 2',
        //                             'icon' => 'fa fa-database',
        //                             'url' => '?r=master2/',
				    //                 'active' => $this->context->route == 'master2/index'
        //                         ]
        //                     ]
        //                 ],
        //                 [
        //                     'label' => 'Lelang',
        //                     'icon' => 'fa fa-bullhorn',
        //                     'url' => ['/user'],
        //                     'active' => $this->context->route == 'user/index',
        //                 ],
        //                 ['label' => 'Penilaian', 'icon' => 'fa fa-calculator', 'url' => ['#'],],
        //                 ['label' => 'Hukum dan Informasi', 'icon' => 'fa fa-balance-scale', 'url' => ['#'],],
        //                 ['label' => 'Kepatuhan Internal', 'icon' => 'fa fa-gavel', 'url' => ['#'],],
        //                 ['label' => 'Umum', 'icon' => 'fa fa-globe', 'url' => ['#'],],
        //                 ['label' => 'Admin', 'icon' => 'fa fa-gear', 'url' => ['admin/index'],
        //                     'items' => [
        //                         [
        //                             'label' => 'Struktur Organisasi',
        //                             'icon' => 'fa fa-institution',
        //                             'url' => ['/kpknl-struktur/index'],
        //                             // 'url' => '?r=admin/referensi/',
        //                             'active' => $this->context->route == '#'
        //                         ],
        //                         [
        //                             'label' => 'Layanan',
        //                             'icon' => 'fa fa-laptop',
        //                             'url' => ['kpknl-layanan/index'],
        //                             // 'url' => '?r=master2/',
        //                             'active' => $this->context->route == '#'
        //                         ],
        //                         [
        //                             'label' => 'Proses Layanan',
        //                             'icon' => 'fa fa-navicon',
        //                             'url' => ['kpknl-layanan-proses/index'],
        //                             // 'url' => '?r=master2/',
        //                             'active' => $this->context->route == '#'
        //                         ]
        //                     ]
        //                 ],
        //                 // ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
        //             ],
        //         ]
        // )
        echo Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'MENU', 'options' => ['class' => 'header']],
                        ['label' => 'Home', 'icon' => 'fa fa-desktop', 
                            'url' => ['/'], 'active' => $this->context->route == 'site/index'
                        ],
                    ],
                ]
        )
        ?>
        
        <?php
        $daftar_seksi = KpknlStruktur::find()
        ->select(['*'])
        ->where(['ur_seksi_singk'=>'PKN'])
        ->orWhere(['ur_seksi_singk'=>'Lelang'])
        ->orWhere(['ur_seksi_singk'=>'Lelang'])
        ->orWhere(['ur_seksi_singk'=>'Penilai'])
        ->orWhere(['ur_seksi_singk'=>'PN'])
        ->orWhere(['ur_seksi_singk'=>'HI'])
        ->orderBy(['id'=>SORT_ASC])
        ->all();
        foreach ($daftar_seksi as $daftar_seksi) {
            $id_seksi = $daftar_seksi->id;
            $ur_seksi = $daftar_seksi->ur_seksi;
            $ur_seksi_singk = $daftar_seksi->ur_seksi_singk;
            $fafa = $daftar_seksi->fafa;
            $items[] = array(
                'label' =>$ur_seksi, 'icon' => $fafa, 'url' => ['admin/'.strtolower($ur_seksi_singk)],
                    // 'items' => [
                    //             [
                    //                 'label' => 'Monitoring pada '.$ur_seksi_singk,
                    //                 'icon' => 'fa fa-search',
                    //                 'url' => ['admin/'.strtolower($ur_seksi_singk)],
                    //                 // 'url' => '?r=admin/referensi/',
                    //                 'active' => $this->context->route == '#'
                    //             ],
                    //         ]
                );
        }

        // echo Menu::widget(
        //         [
        //             'options' => ['class' => 'sidebar-menu'],
        //             'items' => $items,
        //             // [
        //             //     ['label' => 'MENU', 'options' => ['class' => 'header']],
        //             //     ['label' => 'Dashboard', 'icon' => 'fa fa-desktop', 
        //             //         'url' => ['/'], 'active' => $this->context->route == 'site/index'
        //             //     ],

        //             ]
        // );

        // MONITORING DOKUMEN
        echo Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Monitoring Dokumen', 'icon' => 'fa fa-search', 'url' => ['admin/index'],
                            'items' => $items,
                        ],
                        // ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                    ],
                ]
        );


        // LELANG
        echo Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        
                    ],
                ]
        );

        // PKN
        if (
            (Yii::$app->user->identity->username == "pegawaipkn") ||
            (Yii::$app->user->identity->username == "admin") ||
            (Yii::$app->user->identity->username == "super")
            )
        {
        echo Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'PKN', 'icon' => 'fa fa-building', 'url' => ['admin/index'],
                            'items' => [
                                [
                                    'label' => 'Gudang PKN',
                                    'icon' => 'fa fa-building-o',
                                    'url' => ['/gudang-pkn/index'],
                                    // 'url' => '?r=admin/referensi/',
                                    'active' => $this->context->route == '#'
                                ],
                                [
                                    'label' => 'Daftar Lemari',
                                    'icon' => 'fa fa-list',
                                    'url' => ['/lemari-pkn/index'],
                                    // 'url' => '?r=admin/referensi/',
                                    'active' => $this->context->route == '#'
                                ],
                                [
                                    'label' => 'Referensi Satker',
                                    'icon' => 'fa fa-institution',
                                    'url' => ['/satker/index'],
                                    // 'url' => '?r=admin/referensi/',
                                    'active' => $this->context->route == '#'
                                ],
                            ]
                        ],
                        // ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                    ],
                ]
        );
    }
        // KEPATUHAN INTERNAL
        if (
            (Yii::$app->user->identity->username == "pegawaiki") ||
            (Yii::$app->user->identity->username == "admin") ||
            (Yii::$app->user->identity->username == "super")
            )
        {
        echo Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Kepatuhan Internal', 'icon' => 'fa fa-gavel', 'url' => ['admin/index'],
                            'items' => [
                                [
                                    'label' => 'Pengelolaan IKU',
                                    'icon' => 'fa fa-institution',
                                    'url' => ['/iku/index'],
                                    // 'url' => '?r=admin/referensi/',
                                    'active' => $this->context->route == '#'
                                ],
                            ]
                        ],
                        // ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                    ],
                ]
        );
    }
        // HI
        if (
            (Yii::$app->user->identity->username == "pegawaihi") ||
            (Yii::$app->user->identity->username == "admin") ||
            (Yii::$app->user->identity->username == "super")
            )
        {
        echo Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Hukum dan Informasi', 'icon' => 'fa fa-balance-scale', 'url' => ['admin/index'],
                            'items' => [
                                // [
                                //     'label' => 'Layanan Eksternal',
                                //     'icon' => 'fa fa-circle',
                                //     'url' => ['/admin/hi'],
                                //     // 'url' => '?r=admin/referensi/',
                                //     'active' => $this->context->route == '#'
                                // ],
                                [
                                    'label' => 'BKPN',
                                    'icon' => 'fa fa-briefcase',
                                    'url' => ['/bkpn/index'],
                                    // 'url' => '?r=admin/referensi/',
                                    'active' => $this->context->route == '#'
                                ],
                                [
                                    'label' => 'Perkara',
                                    'icon' => 'fa fa-gavel',
                                    'url' => ['/perkara/index'],
                                    // 'url' => '?r=admin/referensi/',
                                    'active' => $this->context->route == '#'
                                ],
                                ['label' => 'Lelang', 'icon' => 'fa fa-bullhorn', 'url' => ['admin/index'],
                                    'items' => [
                                        ['label' => 'Data Lelang', 'icon' => 'fa fa-list', 'url' => ['admin/index'],
                                            'items' => [
                                                [
                                                    'label' => 'Objek Lelang',
                                                    'icon' => 'fa fa-institution',
                                                    'url' => ['/lelang-obyek/index'],
                                                    // 'url' => '?r=admin/referensi/',
                                                    'active' => $this->context->route == '#'
                                                ],
                                                [
                                                    'label' => 'Pemenang Lelang',
                                                    'icon' => 'fa fa-user',
                                                    'url' => ['lelang-pemenang/index'],
                                                    // 'url' => '?r=master2/',
                                                    'active' => $this->context->route == '#'
                                                ],
                                                [
                                                    'label' => 'Risalah Lelang',
                                                    'icon' => 'fa fa-gavel',
                                                    'url' => ['lelang-risalah/index'],
                                                    // 'url' => '?r=master2/',
                                                    'active' => $this->context->route == '#'
                                                ],
                                                [
                                                    'label' => 'Data HBL',
                                                    'icon' => 'fa fa-navicon',
                                                    'url' => ['lelang-setor-hbl/index'],
                                                    // 'url' => '?r=master2/',
                                                    'active' => $this->context->route == '#'
                                                ],
                                            ]
                                        ],
                                        ['label' => 'Referensi', 'icon' => 'fa fa-gear', 'url' => ['admin/index'],
                                            'items' => [
                                                [
                                                    'label' => 'Pejabat Lelang',
                                                    'icon' => 'fa fa-user',
                                                    'url' => ['/lelang-pl/index'],
                                                    // 'url' => '?r=admin/referensi/',
                                                    'active' => $this->context->route == '#'
                                                ],
                                                [
                                                    'label' => 'Jenis Lelang',
                                                    'icon' => 'fa fa-navicon',
                                                    'url' => ['lelang-jenis/index'],
                                                    // 'url' => '?r=master2/',
                                                    'active' => $this->context->route == '#'
                                                ],
                                                [
                                                    'label' => 'Status Lelang',
                                                    'icon' => 'fa fa-navicon',
                                                    'url' => ['lelang-status/index'],
                                                    // 'url' => '?r=master2/',
                                                    'active' => $this->context->route == '#'
                                                ],
                                                [
                                                    'label' => 'Data Rekening',
                                                    'icon' => 'fa fa-navicon',
                                                    'url' => ['lelang-rekening/index'],
                                                    // 'url' => '?r=master2/',
                                                    'active' => $this->context->route == '#'
                                                ],
                                                [
                                                    'label' => 'Jenis Transaksi',
                                                    'icon' => 'fa fa-navicon',
                                                    'url' => ['lelang-rekening-jenis-trn/index'],
                                                    // 'url' => '?r=master2/',
                                                    'active' => $this->context->route == '#'
                                                ],
                                                [
                                                    'label' => 'Penandatangan',
                                                    'icon' => 'fa fa-user',
                                                    'url' => ['lelang-ttd/index'],
                                                    // 'url' => '?r=master2/',
                                                    'active' => $this->context->route == '#'
                                                ],
                                                [
                                                    'label' => 'Lokasi',
                                                    'icon' => 'fa fa-globe',
                                                    'url' => ['lelang-obyek-kab-kota/index'],
                                                    // 'url' => '?r=master2/',
                                                    'active' => $this->context->route == '#'
                                                ]
                                            ]
                                        ],
                                        ['label' => 'Laporan', 'icon' => 'fa fa-book', 'url' => ['admin/index'],
                                            'items' => [
                                                [
                                                    'label' => 'Rekap',
                                                    'icon' => 'fa fa-list',
                                                    'url' => ['/lelang-risalah/report-rekap'],
                                                    // 'url' => '?r=admin/referensi/',
                                                    'active' => $this->context->route == '#'
                                                ],
                                                [
                                                    'label' => 'Tanggal Penyetoran',
                                                    'icon' => 'fa fa-list',
                                                    'url' => ['lelang-risalah/report-tgl'],
                                                    // 'url' => '?r=master2/',
                                                    'active' => $this->context->route == '#'
                                                ],
                                                [
                                                    'label' => 'E Filling',
                                                    'icon' => 'fa fa-book',
                                                    'url' => ['../bendahara/',],
                                                    'target' => '_blank',
                                                    'active' => $this->context->route == '#'
                                                ],
                                            ]
                                        ],
                                    ],
                                ],
                            ],

                        ],

                        // ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                    ],
                ]
        );
    }
        // ADMIN
    if (
            (Yii::$app->user->identity->username == "admin") ||
            (Yii::$app->user->identity->username == "super")
            )
        {
        echo Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Admin', 'icon' => 'fa fa-gear', 'url' => ['admin/index'],
                            'items' => [
                                [
                                    'label' => 'Struktur Organisasi',
                                    'icon' => 'fa fa-institution',
                                    'url' => ['/kpknl-struktur/index'],
                                    // 'url' => '?r=admin/referensi/',
                                    'active' => $this->context->route == '#'
                                ],
                                [
                                    'label' => 'Layanan',
                                    'icon' => 'fa fa-laptop',
                                    'url' => ['kpknl-layanan/index'],
                                    // 'url' => '?r=master2/',
                                    'active' => $this->context->route == '#'
                                ],
                                [
                                    'label' => 'Proses Layanan',
                                    'icon' => 'fa fa-navicon',
                                    'url' => ['kpknl-layanan-proses/index'],
                                    // 'url' => '?r=master2/',
                                    'active' => $this->context->route == '#'
                                ],
                                [
                                    'label' => 'Layanan-Proses',
                                    'icon' => 'fa fa-navicon',
                                    'url' => ['admin/layanan-proses'],
                                    // 'url' => '?r=master2/',
                                    'active' => $this->context->route == '#'
                                ],
                                [
                                    'label' => 'Stakeholder',
                                    'icon' => 'fa fa-user',
                                    'url' => ['kpknl-stakeholder/index'],
                                    // 'url' => '?r=master2/',
                                    'active' => $this->context->route == '#'
                                ],
                                ['label' => 'Akses', 'icon' => 'fa fa-user', 'url' => ['admin/index'],
                                    'items' => [
                                        [
                                            'label' => 'Item',
                                            'icon' => 'fa fa-institution',
                                            'url' => ['/auth-item/index'],
                                            // 'url' => '?r=admin/referensi/',
                                            'active' => $this->context->route == '#'
                                        ],
                                        [
                                            'label' => 'Auth Child',
                                            'icon' => 'fa fa-user',
                                            'url' => ['auth-item-child/index'],
                                            // 'url' => '?r=master2/',
                                            'active' => $this->context->route == '#'
                                        ],
                                        [
                                            'label' => 'Assignment',
                                            'icon' => 'fa fa-gavel',
                                            'url' => ['auth-assignment/index'],
                                            // 'url' => '?r=master2/',
                                            'active' => $this->context->route == '#'
                                        ],
                                        [
                                            'label' => 'User',
                                            'icon' => 'fa fa-user',
                                            'url' => ['user/index'],
                                            // 'url' => '?r=master2/',
                                            'active' => $this->context->route == '#'
                                        ],
                                    ]
                                ],
                            ]
                        ],
                        // ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                    ],
                ]
            );
        }
            // PELELANG
        if (
            (Yii::$app->user->identity->username == "ari") ||
            (Yii::$app->user->identity->username == "ayu") ||
            (Yii::$app->user->identity->username == "budi") ||
            (Yii::$app->user->identity->username == "lidya") ||
            (Yii::$app->user->identity->username == "dimar") ||
            (Yii::$app->user->identity->username == "supiyanta") ||
            (Yii::$app->user->identity->username == "anshori") ||
            (Yii::$app->user->identity->username == "admin") ||
            (Yii::$app->user->identity->username == "super")
            )
        {
            # code...
        
        echo Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Pejabat Lelang', 'icon' => 'fa fa-user', 'url' => ['#'],
                            'items' => [
                                [
                                    'label' => 'Obyek Lelang',
                                    'icon' => 'fa fa-institution',
                                    'url' => ['/lelang-obyek/index'],
                                    // 'url' => '?r=admin/referensi/',
                                    'active' => $this->context->route == '#'
                                ],
                                [
                                    'label' => 'Risalah Lelang',
                                    'icon' => 'fa fa-laptop',
                                    'url' => ['lelang-risalah/index'],
                                    // 'url' => '?r=master2/',
                                    'active' => $this->context->route == '#'
                                ],
                                [
                                    'label' => 'Pemenang Lelang',
                                    'icon' => 'fa fa-navicon',
                                    'url' => ['lelang-pemenang/index'],
                                    // 'url' => '?r=master2/',
                                    'active' => $this->context->route == '#'
                                ],
                                // [
                                //     'label' => 'Rekening Lelang',
                                //     'icon' => 'fa fa-book',
                                //     'url' => ['lelang-rekening/monitoring'],
                                //     // 'url' => '?r=master2/',
                                //     'active' => $this->context->route == '#'
                                // ],

                                // ['label' => 'Rekening', 'icon' => 'fa fa-book', 'url' => ['#'],
                                //             'items' => [
                                                
                                                
                                //                 [
                                //                     'label' => 'Rekening Lelang',
                                //                     'icon' => 'fa fa-book',
                                //                     'url' => ['/rekening-penerimaan/daftar-trx'],
                                //                     // 'url' => '?r=admin/referensi/',
                                //                     'active' => $this->context->route == '#'
                                //                 ],
                                                
                                //                 [
                                //                     'label' => 'Rekening Piutang',
                                //                     'icon' => 'fa fa-book',
                                //                     'url' => ['/rekening-penerimaan/per-trx/',],
                                //                     // 'target' => '_blank',
                                //                     'active' => $this->context->route == '#'
                                //                 ],
                                //                 // [
                                //                 //     'label' => 'Distribusi Dana',
                                //                 //     'icon' => 'fa fa-book',
                                //                 //     'url' => ['/rekening-penerimaan/distribusi-dana/',],
                                //                 //     // 'target' => '_blank',
                                //                 //     'active' => $this->context->route == '#'
                                //                 // ],
                                //                 [
                                //                     'label' => 'Laporan',
                                //                     'icon' => 'fa fa-book',
                                //                     'url' => ['/rekening-saldo-awal/',],
                                //                     // 'target' => '_blank',
                                //                     'active' => $this->context->route == '#'
                                //                 ],

                                //                 [
                                //                     'label' => 'Referensi.',
                                //                     'icon' => 'fa fa-book',
                                //                     'url' => ['/rekening-jenis-trn/',],
                                //                     // 'target' => '_blank',
                                //                     'active' => $this->context->route == '#'
                                //                 ],
                                //             ]
                                //         ],
                            ]
                        ],
                        // ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                    ],
                ]
            );
        }
        
        //BENDAHARA
        if (
            // (Yii::$app->user->identity->username == "ari") ||
            // (Yii::$app->user->identity->username == "ayu") ||
            // (Yii::$app->user->identity->username == "budi") ||
            // (Yii::$app->user->identity->username == "dimar") ||
            // (Yii::$app->user->identity->username == "supiyanta") ||
            (Yii::$app->user->identity->username == "anshori") ||
            (Yii::$app->user->identity->username == "admin") ||
            (Yii::$app->user->identity->username == "super")
            )
        {

        echo Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Bendahara', 'icon' => 'fa fa-book', 'url' => ['#'],
                            'items' => [
                               
                                [
                                    'label' => 'My Task',
                                    'icon' => 'fa fa-pencil',
                                    'url' => ['/rekening-penerimaan/my-task'],
                                    // 'url' => '?r=admin/referensi/',
                                    'active' => $this->context->route == '#'
                                ],
                                [
                                    'label' => 'Rekening Lelang',
                                    'icon' => 'fa fa-list',
                                    'url' => ['/rekening-penerimaan/daftar-trx'],
                                    // 'url' => '?r=admin/referensi/',
                                    'active' => $this->context->route == '#'
                                ],
                                
                                [
                                    'label' => 'Rekening Piutang',
                                    'icon' => 'fa fa-list',
                                    'url' => ['#',],
                                    // 'target' => '_blank',
                                    'active' => $this->context->route == '#'
                                ],
                                // [
                                //     'label' => 'Distribusi Dana',
                                //     'icon' => 'fa fa-book',
                                //     'url' => ['/rekening-penerimaan/distribusi-dana/',],
                                //     // 'target' => '_blank',
                                //     'active' => $this->context->route == '#'
                                // ],
                                 [
                                    'label' => 'Laporan',
                                    'icon' => 'fa fa-book',
                                    'url' => ['/rekening-saldo-awal/',],
                                    // 'target' => '_blank',
                                    'active' => $this->context->route == '#'
                                ],
                                [
                                    'label' => 'Referensi',
                                    'icon' => 'fa fa-gear',
                                    'url' => ['/rekening-jenis-trn/',],
                                    // 'target' => '_blank',
                                    'active' => $this->context->route == '#'
                                ],
                            ],
                        ],
                        // ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                    ],
                ]
            );
        }
        ?>



        
<?php
}
?>
    </section>
    <!-- /.sidebar -->
</aside>