<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LelangHeaderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Lelang';
$this->params['breadcrumbs'][] = ['label' => 'Penatausahaan Lelang', 'url' => ['lelang/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-header-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Data Lelang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'tahun',
            // 'stakeholder',
            [
                'attribute' => 'stakeholder',
                'value' =>function($data){
                    return $data->stakeholder0->nama;
                }
            ],
            // 'uraian_barang:ntext',
            [
            'attribute'=>'uraian_barang',
            'contentOptions' => ['style' => 'width:50%; white-space: normal;'],
            ],

            // 'keterangan:ntext',
            // 'progres',
            [
                'attribute' => 'progres',
                'value' =>function($data){
                    return $data->progres0->ur_status;
                }
            ],
            // 'no_rl',
            // 'tgl_rl',
            // 'hpl',
            // 'pejabat',
            // 'jml_pelunasan',
            // 'tgl_pelunasan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
