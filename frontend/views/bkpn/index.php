<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BkpnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Berkas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bkpn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-bookmark"></span> Register Baru', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-th-list"></span> Rekap', ['bkpn-rekap'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-user"></span> Daftar Peminjam', ['/bkpn-pinjam'], ['class' => 'btn btn-default']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nrpn',
            'ph_nama',
            'pp_nama',
            // 'nilai_penyerahan',
            [
                'attribute' => 'nilai_penyerahan',
                'format' =>['decimal',],
                // 'class' => 'text-left',
            ],
            // 'keterangan:ntext',
            [
                'attribute' => 'status',
                'value' =>function($data){
                    return $data->status0->ur_status;
                }
            ],
            'no_box',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
