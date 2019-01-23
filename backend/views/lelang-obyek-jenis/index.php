<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LelangObyekJenisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lelang Obyek Jenis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-obyek-jenis-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lelang Obyek Jenis', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'uraian',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
