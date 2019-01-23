<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LelangPemenangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Pemenang Lelang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-pemenang-index">

    <?= Html::a('Obyek Lelang', ['lelang-obyek/index'], ['class' => 'btn btn-default']) ?>
    <?= Html::a('Risalah Lelang', ['lelang-risalah/index'], ['class' => 'btn btn-default']) ?>
    <?= Html::a('Pemenang Lelang', ['lelang-pemenang/index'], ['class' => 'btn btn-default']) ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'nama_pemenang',
            'alamat_pemenang:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
