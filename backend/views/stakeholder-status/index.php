<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StakeholderStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stakeholder Statuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stakeholder-status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Stakeholder Status', ['create'], ['class' => 'btn btn-success']) ?>
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
