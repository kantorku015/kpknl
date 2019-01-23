<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IkuCapaianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Iku Capaians';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iku-capaian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Iku Capaian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_pic',
            'capaian_q1',
            'capaian_q2',
            'capaian_q3',
            //'capaian_q4',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
