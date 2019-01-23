<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BkpnStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bkpn Statuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bkpn-status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bkpn Status', ['create'], ['class' => 'btn btn-success']) ?>
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
