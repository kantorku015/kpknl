<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LelangSetorHblSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lelang Setor Hbls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-setor-hbl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lelang Setor Hbl', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'sppb_no',
            // 'sppb_tgl',
            'surat_no',
            'surat_tgl',
            // 'surat_perihal:ntext',
            'rek_tujuan_no',
            'rek_tujuan_an',
            'rek_tujuan_bank',
            // 'penjual_alamat:ntext',
            // 'cf',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
