<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RekeningJenisTrnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rekening Jenis Trns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekening-jenis-trn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rekening Jenis Trn', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'jns_rek',
            'm_k',
            'ur_trn',
            'hak_negara',
            //'idx1',
            //'idx2',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
