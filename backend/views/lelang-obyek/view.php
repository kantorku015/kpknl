<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangObyek */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lelang Obyeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-obyek-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'pemohon_lelang',
            'kode_lelang',
            // 'jenis_lelang',
            [
                'attribute' => 'jenis_lelang',
                'value' =>$model->jenisLelang->ur_jenis,
            ],
            // [
            //     'attribute' => 'id_jenis',
            //     'value' =>$model->idJenis->uraian,
            // ],
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
            'rph_pokok',
            'persen_penjual',
            'persen_pembeli',
            'persen_pph',
            'rph_batal',
            'rph_wanprestasi',
            'batas_lunas',
            'rph_lunas',
            'jurnal_rek',
            'tgl_jurnal',
            'kuitansi_no',
            'kuitansi_abc',
            'tgl_setor_hbl',
            'id_setor_hbl',
            'tgl_setor_pnbp',
            'billing_pnbp',
            'billing_ssp',
            'catatan:ntext',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
            'letak_tanah_bangunan:ntext',
            'status_tanah_bangunan',
            'nama_debitur',
            'alamat_debitur:ntext',
            'npwp_debitur',
            'luas_tanah',
            'luas_bangunan',
            'nop',
            'kab_kota',
        ],
    ]) ?>

</div>
