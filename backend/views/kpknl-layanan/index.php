<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KpknlLayananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referensi Layanan KPKNL';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kpknl-layanan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'id_seksi',
                'value' =>function($data){
                    return $data->idSeksi->ur_seksi;
                }
            ],
            'ur_layanan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
