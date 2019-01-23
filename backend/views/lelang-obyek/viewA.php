<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangObyek */

$this->title = "ID: ".$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Obyek Lelang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-obyek-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('+ Pemenang', ['lelang-pemenang/index'], ['class' => 'btn btn-default', 'target' => '_blank']) ?>
        <?= Html::a('Tambah Data RL', ['lelang-risalah/index'], ['class' => 'btn btn-warning']) ?>
        <br><br>
        <?= Html::a('Tambah Obyek Lain', ['lelang-obyek/create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Tambah Obyek Lain - Batal', ['lelang-obyek/create-batal'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'pemohon_lelang',
            'kode_lelang',
            // 'jenis_lelang',
            [
                'attribute' => 'jenis_lelang',
                'value' =>$model->jenisLelang->ur_jenis,
            ],
            // 'obyek_lelang:ntext',
            [
            'attribute'=>'obyek_lelang',
            'contentOptions' => ['style' => 'width:75%; white-space: normal;'],
            // 'value'=> function ($model){
            // return $model['obyek_lelang'];
            // }
            ],
            'obyek_lelang_sing',
            'tempat_lelang',
            'lot',
            // 'rph_limit',
            [
                'attribute' => 'rph_limit',
                'value' =>number_format($model->rph_limit,2,",","."),
            ],

            // 'rph_jaminan',
            [
                'attribute' => 'rph_jaminan',
                'value' =>number_format($model->rph_jaminan,2,",","."),
            ],
            'balai_lelang',
            // 'status_lelang',
            [
                'attribute' => 'status_lelang',
                'value' =>$model->statusLelang->ur_status,
            ],
            'rl_no',
            // 'id_pemenang',
            [
                'attribute' => 'id_pemenang',
                'value' =>$model->idPemenang->nama_pemenang,
                // 'value' => function ($data) {
                //     if (isset($model->id_pemenang)){
                //       // return $model->subCategory->subcat_name;
                //       return $model->idPemenang->nama_pemenang;
                //       } else {
                //       return '';
                //       }
                // },
            ],
        ],
    ]) ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'rph_pokok',
            [
                'attribute' => 'rph_pokok',
                'value' =>number_format($model->rph_pokok,2,",","."),
            ],
            // 'persen_penjual',
            [
                'attribute' => 'persen_penjual',
                'value' =>"(".number_format($model->persen_penjual,2,",",".")."%) Rp".number_format($model->persen_penjual/100*$model->rph_pokok,2,",","."),
            ],
            // 'persen_pembeli',
            [
                'attribute' => 'persen_pembeli',
                'value' =>"(".number_format($model->persen_pembeli,2,",",".")."%) Rp".number_format($model->persen_pembeli/100*$model->rph_pokok,2,",","."),
            ],
            // 'persen_pph',
            [
                'attribute' => 'persen_pph',
                'value' =>"(".number_format($model->persen_pph,2,",",".")."%) Rp".number_format($model->persen_pph/100*$model->rph_pokok,2,",","."),
            ],
            // 'rph_batal',
            [
                'attribute' => 'rph_batal',
                'value' =>number_format($model->rph_batal,2,",","."),
            ],
            // 'rph_wanprestasi',
            [
                'attribute' => 'rph_wanprestasi',
                'value' =>number_format($model->rph_wanprestasi,2,",","."),
            ],
            'batas_lunas',
            // 'rph_lunas',
            [
                'attribute' => 'rph_lunas',
                'value' =>number_format($model->rph_lunas,2,",","."),
            ],
            'jurnal_rek',
            'kuitansi_no',
            'kuitansi_abc',
            'tgl_setor_hbl',
            'id_setor_hbl',
            'tgl_setor_pnbp',
            'billing_pnbp',
            'billing_ssp',
            // 'catatan:ntext',
            [
            'attribute'=>'catatan',
            'contentOptions' => ['style' => 'width:75%; white-space: normal;'],
            // 'value'=> function ($model){
            // return $model['obyek_lelang'];
            // }
            ],
        ],
    ]) ?>

</div>
