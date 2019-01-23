<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\LelangHitung;
/* @var $this yii\web\View */
/* @var $model backend\models\LelangHeader */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penatausahaan Lelang', 'url' => ['lelang/index']];
$this->params['breadcrumbs'][] = ['label' => 'Daftar Lelang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-header-view">

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
            'tahun',
            // 'stakeholder',
            [
                'attribute' => 'stakeholder',
                'value' =>$model->stakeholder0->nama,
            ],
            'uraian_barang:ntext',
            'keterangan:ntext',
            // 'progres',
            [
                'attribute' => 'progres',
                'value' =>$model->progres0->ur_status,
            ],
            'no_rl',
            'tgl_rl',
            'hpl',
            // 'pejabat',
            [
                'attribute' => 'pejabat',
                'value' =>$model->pejabat0->nama,
            ],
            'jml_pelunasan',
            'tgl_pelunasan',
        ],
    ]) ?>

    <?php
        #cek apakah sudah ada penyetoran
        $cari = LelangHitung::find()
        ->select(['*'])
        ->where(['id_lelang' => $model->id])
        ->one();
        if ($cari) {
            $id_setor = $cari->id;
            // echo 'sudah ada penyetoran';
            echo Html::beginForm('../lelang-hitung/update','get',['class' => 'form-inline']);
                echo Html::textInput('id',$id_setor,['class'=>'form-control required','type'=>'hidden']);
                echo Html::submitButton('Setor Hasil Lelang',['class'=>'btn btn-success']);
            echo Html::endForm();
        }
        else{
            echo Html::beginForm('../lelang-hitung/create','post',['class' => 'form-inline']);
                echo Html::textInput('id_lelang',$model->id,['class'=>'form-control required','type'=>'hidden']);
                echo Html::submitButton('Setor Hasil Lelang',['class'=>'btn btn-success']);
            echo Html::endForm();
        }
        ?>

</div>
