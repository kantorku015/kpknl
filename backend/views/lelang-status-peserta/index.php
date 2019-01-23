<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LelangStatusPesertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lelang Status Pesertas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-status-peserta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lelang Status Peserta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ur_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
