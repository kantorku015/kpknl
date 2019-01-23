<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use backend\models\BkpnPinjam;
use backend\models\BkpnProses;
use backend\models\BkpnProsesRef;
/* @var $this yii\web\View */
/* @var $model backend\models\Bkpn */

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
        <?= Html::a('Proses', ['/bkpn-proses/create', 'nrpn' => $model->nrpn], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Mau menambah proses pada berkas ini?',
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
                'value' => function ($data) {
                      return $data->status0->ur_status;
                    // if (isset($model->status)){
                    //   // return $model->subCategory->subcat_name;
                    //   return $data->status0->ur_status;
                    //   } else {
                    //   return '';
                    //   }
                },
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

<h2>Daftar Proses</h2>
<table class="table table-striped table-hover table-bordered">
    <thead>
        <th class="text-center bg-primary">No</th>
        <th class="text-center bg-primary">Proses</th>
        <th class="text-center bg-primary">Tanggal</th>
        <th class="text-center bg-primary">Keterangan</th>
        <th class="text-center bg-primary">Action</th>
    </thead>
    <tbody>
    <?php
    $no_proses = 1;
    $daftar_proses = BkpnProses::find()
        ->select(['*'])
        ->where(['nrpn'=>$model->nrpn])
        ->orderBy(['tgl_proses'=>SORT_ASC])->all();
    foreach ($daftar_proses as $daftar_proses) {
        $id_proses = $daftar_proses->id;
        $id_proses_ref = $daftar_proses->id_proses;
            $data_proses = BkpnProsesRef::find()
                ->select(['*'])
                ->where(['id'=>$id_proses_ref])
                ->orderBy(['id'=>SORT_ASC])->one();
                $ur_proses = $data_proses->ur_proses;
        $tgl_proses = $daftar_proses->tgl_proses;
        $keterangan = $daftar_proses->keterangan;
    ?>
        <tr>
            <td class="text-center"><?=$no_proses?>.</td>
            <td><?=$ur_proses?></td>
            <td><?=date_format(date_create($tgl_proses),"d-m-Y")?></td>
            <td><?=$keterangan?></td>
            <td>
                <table>
                    <tbody>
                        <tr>
                            <td>
                            <?php
                            echo Html::beginForm('../bkpn-proses/update','get',['class' => 'form-inline']);
                                echo Html::textInput('id',$id_proses,['class'=>'form-control required','type'=>'hidden']);
                                echo Html::submitButton('<span class="glyphicon glyphicon-pencil"></span> Ubah',['class'=>'btn btn-link']);
                            echo Html::endForm();
                            ?>
                            </td>
                            <td>
                            <?php
                            echo Html::a('<span class="glyphicon glyphicon-trash"></span> Hapus', Url::toRoute(['/bkpn-proses/delete', 'id' => $id_proses]), ['data-method' => 'post', 'class' => 'btn btn-link'])
                            ?>
                            </td>
                        </tr>   
                    </tbody>
                </table>
            </td>
        </tr>
        <?php
        $no_proses++;
    }
        ?>
    </tbody>
</table>

</div>
