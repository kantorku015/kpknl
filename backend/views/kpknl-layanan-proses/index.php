<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KpknlLayananProsesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referensi Daftar Proses Layanan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kpknl-layanan-proses-index">

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
            // 'id_layanan',
            [
                'attribute' => 'id_seksi',
                'value' =>function($data){
                    return $data->idSeksi->ur_seksi;
                }
            ],
            [
                'attribute' => 'id_layanan',
                'value' =>function($data){
                    return $data->idLayanan->ur_layanan;
                }
            ],
            'ur_proses',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
