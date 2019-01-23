<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\LelangUangJaminan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penatausahaan Lelang', 'url' => ['lelang/index']];
$this->params['breadcrumbs'][] = ['label' => 'Daftar Uang Jaminan Lelang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-uang-jaminan-view">

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
            // 'id_lelang',
            [
                'attribute' => 'id_lelang',
                'value' =>$model->idLelang->uraian_barang,
            ],
            // 'peserta',
            [
                'attribute' => 'peserta',
                'value' =>$model->peserta0->nama,
            ],
            // 'jml_jaminan',
            [
                'attribute' => 'jml_jaminan',
                'value' =>number_format($model->jml_jaminan,2,",","."),
            ],
            // 'status',
            [
                'attribute' => 'status',
                'value' =>$model->status0->ur_status,
            ],
            'tgl_setor',
            'tempat_setor',
            'tgl_kembali',
            'tempat_kembali',
        ],
    ]) ?>

</div>
