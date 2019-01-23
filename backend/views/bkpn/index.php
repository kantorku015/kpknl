<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\widgets\ListView;
use kartik\grid\GridView;
// use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BkpnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Berkas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bkpn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-bookmark"></span> Register Baru', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-th-list"></span> Rekap', ['bkpn-rekap'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-user"></span> Daftar Peminjam', ['/bkpn-pinjam'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-print"></span> Cetak', ['bkpn-cetak'], ['class' => 'btn btn-default']) ?>
    </p>
    <?= GridView::widget([
        'moduleId' => 'gridview',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nrpn',
            'ph_nama',
            'pp_nama',
            // 'nilai_penyerahan',
            [
                'attribute' => 'nilai_penyerahan',
                'format' =>['decimal',],
                // 'class' => 'text-left',
            ],
            // 'keterangan:ntext',
            [
                'attribute' => 'status',
                // 'value' =>function($data){
                //     return $data->status0->ur_status;
                // }
                'value' => function ($data) {
                      return $data->status0->ur_status;
                    // if (isset($model->status)){
                    //   // return $model->subCategory->subcat_name;
                    //   return $data->status0->ur_status;
                    //   } else {
                    //   return '';
                    //   }
                },
            ],
            'no_box',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        // 'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
        'floatHeader'=>true,
        'floatHeaderOptions'=>['scrollingTop'=>'50'],
        // 'showPageSummary' => true,
        'hover' => true,
        // 'perfectScrollbar' => true,
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
            // 'beforeGrid'=>'My fancy content before.',
            // 'afterGrid'=>'My fancy content after.',
        ],
        // 'responsive'=>true,
        'resizableColumns' => true,
        'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
        // 'toolbar' => [
        //     [
        //         'content'=>
        //             Html::button('<i class="glyphicon glyphicon-plus"></i>', [
        //                 'type'=>'button', 
        //                 'title'=>Yii::t('kvgrid', 'Add Book'), 
        //                 'class'=>'btn btn-success'
        //             ]) . ' '.
        //             Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
        //                 'class' => 'btn btn-default', 
        //                 'title' => Yii::t('kvgrid', 'Reset Grid')
        //             ]),
        //     ],
        //     '{export}',
        //     '{toggleData}'
        // ],
         'toolbar' =>  [
                ['content' => 
                    Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
                ],
                '{export}',
                '{toggleData}',
            ],
        'export' => [
            'fontAwesome' => true
        ],
        'toggleDataContainer' => ['class' => 'btn-group-sm'],
        'exportContainer' => ['class' => 'btn-group-sm'],
        'beforeHeader' => ['content' => 'JUDUL', 'exportConversions ' => 'Active'],
        'afterHeader' => ['content' => 'JUDUL'],
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],

    ]); ?>

    <?php
    // echo ExportMenu::widget([
    //         'dataProvider' => $provider,
    //         'columns' => $export_columns,
    //         'target' => ExportMenu::TARGET_SELF,
    //         'showConfirmAlert' => false,
    //         'showColumnSelector' => false,
    //         'exportConfig' => [
    //             ExportMenu::FORMAT_HTML => false,
    //             ExportMenu::FORMAT_TEXT => false,
    //         ],
    //         'filename' => 'exported-data_' . date('Y-m-d_H-i-s'),
    //     ]); 
        ?>

</div>
