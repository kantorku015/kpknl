<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RequestResponSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Request Respons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-respon-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Request Respon', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ticket_code',
            'id_respon',
            'comment:ntext',
            'tgl_respon',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
