<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IkuJenisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Iku Jenis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iku-jenis-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Iku Jenis', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ur_jenis',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
