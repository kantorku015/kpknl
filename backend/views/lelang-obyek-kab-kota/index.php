<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LelangObyekKabKotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lelang Obyek Kab Kotas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-obyek-kab-kota-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lelang Obyek Kab Kota', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama_kab_kota',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
