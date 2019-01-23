<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IkuTargetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Iku Targets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iku-target-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Iku Target', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_pic',
            'target_q1',
            'target_q2',
            'target_q3',
            //'target_q4',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
