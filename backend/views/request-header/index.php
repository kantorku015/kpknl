<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RequestHeaderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Penerimaan Dokumen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-header-index">

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
                'attribute' => 'id_stakeholder',
                'value' =>function($data){
                    return $data->stakeholder->nama;
                }
            ],
            'no_dokumen',
            'tgl_dok',
            // 'id_layanan',
            [
                'attribute' => 'id_layanan',
                'value' =>function($data){
                    return $data->layanan->ur_layanan;
                }
            ],
            'tgl_terima',
            'ticket_code',
            'keterangan:ntext',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
