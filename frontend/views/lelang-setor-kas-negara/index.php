<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LelangSetorKasNegaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lelang Setor Kas Negaras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-setor-kas-negara-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lelang Setor Kas Negara', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tgl_bl_penjual',
            'tgl_bl_pembeli',
            'tgl_bl_batal',
            'tgl_pph_final',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
