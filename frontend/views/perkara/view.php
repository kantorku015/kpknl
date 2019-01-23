<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\PerkaraPinjam;
/* @var $this yii\web\View */
/* @var $model frontend\models\Perkara */

$this->title = $model->no_perkara;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Perkara', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkara-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->no_perkara], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->no_perkara], [
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
            'no_perkara',
            'tempat',
            'tahun',
            'nama_penggugat',
            'posisi_kpknl',
            'no_box',
            'ket:ntext',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',
        ],
    ]) ?>

    <?php
        #cek apakah masih dipinjam
        $cari = PerkaraPinjam::find()
        ->select(['*'])
        ->where(['no_perkara' => $model->no_perkara])
        ->andWhere(['tgl_kembali' => NULL])
        ->one();
        if ($cari) {
            $peminjam = $cari->peminjam;
            $tgl_pinjam = $cari->tgl_pinjam;
            echo '<b>Berkas sedang dipinjam oleh '.$peminjam.", tanggal ".$tgl_pinjam.".</b>";
        }
        else{
            // echo 'bisa dipinjam';


        echo Html::beginForm('../perkara-pinjam/create','post',['class' => 'form-inline']);
            echo Html::textInput('no_perkara',$model->no_perkara,['class'=>'form-control required','type'=>'hidden']);
            echo Html::submitButton('Pinjam',['class'=>'btn btn-success']);
        echo Html::endForm();
        }
        ?>

</div>
