<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\PerkaraPinjam;
/* @var $this yii\web\View */
/* @var $model backend\models\Perkara */

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
            $keterangan = $cari->keterangan;
            $id_pinjam = $cari->id;
            echo '<b>Berkas sedang dipinjam oleh '.$peminjam.", tanggal ".date_format(date_create($tgl_pinjam),"d-M-Y").". <br>Ket: ".$keterangan.".</b><hr>";

            echo Html::beginForm('../perkara-pinjam/update','get',['class' => 'form-inline']);
                echo Html::textInput('id',$id_pinjam,['class'=>'form-control required','type'=>'hidden']);
                echo Html::submitButton('Ubah Data Peminjaman',['class'=>'btn btn-success']);
            echo Html::endForm();

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
