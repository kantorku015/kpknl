<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PerkaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perkara';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkara-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Tambah Perkara', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-th-list"></span> Rekap', ['perkara-rekap'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-user"></span> Daftar Peminjam', ['perkara-pinjam/index'], ['class' => 'btn btn-default']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'no_perkara',
            [
            'attribute'=>'no_perkara',
            'contentOptions' => ['style' => 'width:50%; white-space: normal;'],
            // 'value'=> function ($model){
            // return $model['no_perkara'];
            // }
            ],
            'tempat',
            'tahun',
            // 'nama_penggugat',
            [
            'attribute'=>'nama_penggugat',
            'contentOptions' => ['style' => 'width:50%; white-space: normal;'],
            // 'value'=> function ($model){
            // return $model['no_perkara'];
            // }
            ],
            'posisi_kpknl',
            // 'status',
            [
                'attribute' => 'status',
                'value' =>function($data){
                    return $data->status0->ur_status;
                }
            ],
            'no_box',
            // 'ket:ntext',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
