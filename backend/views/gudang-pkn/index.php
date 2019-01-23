<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GudangPknSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Berkas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-pkn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Berkas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'id_lemari',
            [
                'attribute' => 'id_lemari',
                'value' =>function($data){
                    return $data->lemari->ur_lemari;
                }
            ],
            // 'id_satker',
             [
                'attribute' => 'id_satker',
                'value' =>function($data){
                    return $data->satker->ur_satker;
                }
            ],
            'isi_berkas:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
