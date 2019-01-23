<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangSetorHbl */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lelang Setor Hbls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-setor-hbl-view">

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
            'sppb_no',
            'sppb_tgl',
            'surat_no',
            'surat_tgl',
            'surat_perihal:ntext',
            'rek_tujuan_no',
            'rek_tujuan_an',
            'rek_tujuan_bank',
            'penjual_alamat:ntext',
            'cf',
        ],
    ]) ?>

</div>
