<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PerkaraPinjamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Peminjaman Berkas Perkara';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkara-pinjam-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-download"></span> Pinjam Berkas', ['perkara/index'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
            'attribute'=>'no_perkara',
            'contentOptions' => ['style' => 'width:50%; white-space: normal;'],
            // 'value'=> function ($model){
            // return $model['no_perkara'];
            // }
            ],
            'peminjam',
            'tgl_pinjam',
            'tgl_kembali',
            // 'keterangan:ntext',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
