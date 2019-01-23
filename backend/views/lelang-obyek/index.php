<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LelangObyekSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Obyek Lelang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-obyek-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /*echo Html::a('+ Obyek Lelang - Tanah Bangunan', ['create-tanah-bangunan'], ['class' => 'btn btn-primary'])*/ ?>
        <?php /*echo Html::a('+ Obyek - Selain Tanah Bangunan', ['create'], ['class' => 'btn btn-success'])*/ ?>
        <?php echo Html::a('+ Obyek', ['create'], ['class' => 'btn btn-success']) ?>
        <?php echo Html::a('+ Obyek Lelang - Batal', ['create-batal'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'pemohon_lelang',
            'kode_lelang',
            'jenis_lelang',
            // 'obyek_lelang:ntext',
            [
            'attribute'=>'obyek_lelang',
            'contentOptions' => ['style' => 'width:50%; white-space: normal;'],
            // 'value'=> function ($model){
            // return $model['obyek_lelang'];
            // }
            ],
            //'obyek_lelang_sing',
            //'tempat_lelang',
            //'lot',
            //'rph_limit',
            //'rph_jaminan',
            //'balai_lelang',
            //'status_lelang',
            'rl_no',
            //'id_pemenang',
            [
                'attribute' => 'id_pemenang',
                'value' =>function($data){
                    return $data->idPemenang->nama_pemenang;
                }
                // 'value' => function ($data) {
                //     if (isset($model->id_pemenang)){
                //       // return $model->subCategory->subcat_name;
                //       return $model->idPemenang->nama_pemenang;
                //       } else {
                //       return '';
                //       }
                // },
            ],
            //'rph_pokok',
            //'persen_penjual',
            //'persen_pembeli',
            //'persen_pph',
            //'rph_batal',
            //'rph_wanprestasi',
            'batas_lunas',
            //'rph_lunas',
            [
                'attribute' => 'rph_lunas',
                'format' =>['decimal',2],
            ],
            'jurnal_rek',
            //'tgl_jurnal',
            //'kuitansi_no',
            //'kuitansi_abc',
            //'tgl_setor_hbl',
            //'id_setor_hbl',
            //'tgl_setor_pnbp',
            'billing_pnbp',
            'billing_ssp',
            //'catatan:ntext',
            //'created_by',
            //'created_at',
            //'updated_by',
            //'updated_at',
            //'letak_tanah_bangunan:ntext',
            //'status_tanah_bangunan',
            //'nama_debitur',
            //'alamat_debitur:ntext',
            //'npwp_debitur',
            //'luas_tanah',
            //'luas_bangunan',
            //'nop',
            //'kab_kota',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
