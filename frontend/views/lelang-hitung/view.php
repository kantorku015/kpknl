<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\LelangHitung */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penatausahaan Lelang', 'url' => ['lelang/index']];
$this->params['breadcrumbs'][] = ['label' => 'Daftar Setor Hasil Lelang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-hitung-view">

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
            // 'bl_penjual',
            [
                'attribute' => 'bl_penjual',
                'value' =>$model->bl_penjual,
                'value' =>number_format($model->idLelang->hpl * $model->bl_penjual,2,",","."),
            ],
            'tgl_bl_penjual',
            // 'bl_pembeli',
            [
                'attribute' => 'bl_pembeli',
                'value' =>$model->bl_penjual,
                'value' =>number_format($model->idLelang->hpl * $model->bl_pembeli,2,",","."),
            ],
            'tgl_bl_pembeli',
            // 'bl_batal',
            [
                'attribute' => 'bl_batal',
                'value' =>$model->bl_batal,
                'value' =>number_format($model->idLelang->hpl * $model->bl_batal,2,",","."),
            ],
            'tgl_bl_batal',
            // 'pph_final',
            [
                'attribute' => 'pph_final',
                'value' =>$model->pph_final,
                'value' =>number_format($model->idLelang->hpl * $model->pph_final,2,",","."),
            ],
            'tgl_pph_final',
        ],
    ]) ?>

</div>
