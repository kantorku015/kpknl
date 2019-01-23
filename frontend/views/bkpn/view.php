<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use frontend\models\BkpnPinjam;
/* @var $this yii\web\View */
/* @var $model frontend\models\Bkpn */

$this->title = 'NRPN - '.$model->nrpn;
$this->params['breadcrumbs'][] = ['label' => 'Daftar BKPN', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bkpn-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->nrpn], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->nrpn], [
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
            'nrpn',
            'ph_nama',
            'pp_nama',
            // 'nilai_penyerahan',
            [
                'attribute' => 'nilai_penyerahan',
                'format' =>['decimal',2],
            ],
            'keterangan:ntext',
            [
                'attribute' => 'Status Berkas',
                'value' =>$model->status0->ur_status,
            ],
            'no_box',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',
        ],
    ]) ?>
        
        <?php
        #cek apakah masih dipinjam
        $cari = BkpnPinjam::find()
        ->select(['*'])
        ->where(['nrpn' => $model->nrpn])
        ->andWhere(['tgl_kembali' => NULL])
        ->one();
        if ($cari) {
            $peminjam = $cari->peminjam;
            $tgl_pinjam = $cari->tgl_pinjam;
            echo '<b>Berkas sedang dipinjam oleh '.$peminjam.", tanggal ".$tgl_pinjam.".</b>";
        }
        else{
            // echo 'bisa dipinjam';


        echo Html::beginForm('../bkpn-pinjam/create','post',['class' => 'form-inline']);
            echo Html::textInput('nrpn',$model->nrpn,['class'=>'form-control required','type'=>'hidden']);
            echo Html::submitButton('Pinjam',['class'=>'btn btn-success']);
        echo Html::endForm();
        }
        ?>

</div>
