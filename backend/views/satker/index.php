<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SatkerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Satker';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="satker-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Satker', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'kd_satker',
            'ur_satker',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
