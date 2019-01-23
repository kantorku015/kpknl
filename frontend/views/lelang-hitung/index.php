<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LelangHitungSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penyetoran Hasil Lelang';
$this->params['breadcrumbs'][] = ['label' => 'Penatausahaan Lelang', 'url' => ['lelang/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-hitung-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Data Setor Hasil Lelang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'id_lelang',
            [
                'attribute' => 'id_lelang',
                'contentOptions' => ['style' => 'width:50%; white-space: normal;'],
                'value' =>function($data){
                    return $data->idLelang->uraian_barang;
                }
            ],
            // 'bl_penjual',
            [
                'label' => 'HPL',
                'format' =>['decimal',2],
                'value' =>function($data){
                    return $data->idLelang->hpl;
                }
            ],
            [
                'attribute' => 'bl_penjual',
                'format' =>['decimal',2],
                'value' =>function($data){
                    return $data->idLelang->hpl * $data->bl_penjual;
                }
            ],
            // 'tgl_bl_penjual',
            // 'bl_pembeli',
            [
                'attribute' => 'bl_pembeli',
                'format' =>['decimal',2],
                'value' =>function($data){
                    return $data->idLelang->hpl * $data->bl_pembeli;
                }
            ],
            // 'tgl_bl_pembeli',
            // 'bl_batal',
            [
                'attribute' => 'bl_batal',
                'format' =>['decimal',2],
                'value' =>function($data){
                    return $data->idLelang->hpl * $data->bl_batal;
                }
            ],
            // 'tgl_bl_batal',
            // 'pph_final',
            [
                'attribute' => 'pph_final',
                'format' =>['decimal',2],
                'value' =>function($data){
                    return $data->idLelang->hpl * $data->pph_final;
                }
            ],
            // 'tgl_pph_final',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
