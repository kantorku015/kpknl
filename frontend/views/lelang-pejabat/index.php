<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LelangPejabatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lelang Pejabats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-pejabat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lelang Pejabat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama',
            'nip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
