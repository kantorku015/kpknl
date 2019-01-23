<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BkpnProsesRefSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bkpn Proses Refs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bkpn-proses-ref-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bkpn Proses Ref', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ur_proses',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
