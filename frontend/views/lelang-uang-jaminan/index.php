<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LelangUangJaminanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Uang Jaminan';
$this->params['breadcrumbs'][] = ['label' => 'Penatausahaan Lelang', 'url' => ['lelang/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-uang-jaminan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Uang Jaminan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'id_lelang',
            [
                'attribute' => 'id_lelang',
                'contentOptions' => ['style' => 'width:50%; white-space: normal;'],
                'value' =>function($data){
                    return $data->idLelang->uraian_barang;
                }
            ],
            // 'peserta',
            [
                'attribute' => 'peserta',
                'contentOptions' => ['style' => 'width:50%; white-space: normal;'],
                'value' =>function($data){
                    return $data->peserta0->nama;
                }
            ],
            // 'jml_jaminan',
            [
                'attribute' => 'jml_jaminan',
                'format' =>['decimal',2],
            ],

            // 'status',
            [
                'attribute' => 'status',
                'contentOptions' => ['style' => 'width:50%; white-space: normal;'],
                'value' =>function($data){
                    return $data->status0->ur_status;
                }
            ],
            'tgl_setor',
            // 'tempat_setor',
            'tgl_kembali',
            // 'tempat_kembali',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
