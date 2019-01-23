<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Perkara1Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perkara1s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkara1-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Perkara1', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_perkara',
            'tempat',
            'tahun',
            'nama_penggugat',
            //'posisi_kpknl',
            //'status',
            //'no_box',
            //'ket:ntext',
            //'created_by',
            //'created_at',
            //'updated_by',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
