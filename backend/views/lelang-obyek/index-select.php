<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\LelangObyek;
use backend\models\LelangObyekJenis;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LelangObyekSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pilih Objek Lelang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-obyek-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <kbd>Cari obyek lelang yang akan dimasukkan pada Risalah Lelang nomor <?=$_GET['id_rl']?></kbd>

<hr>
    <table class="table table-striped table-hover table-bordered">
        <thead>
        <tr>
            <th class="text-center bg-primary">No</th>
            <th class="text-center bg-primary">Objek Lelang</th>
            <th class="text-center bg-primary">Pilih</th>
        </tr>
        </thead>
        <tbody>
            <?php
            #daftar obyek lelang yang belum punya RL
            $no_urut = 1;
            $daftar_obyek = LelangObyek::find()
                ->select(['*'])
                ->where(['rl_no'=>NULL])
                ->orderBy(['id'=>SORT_ASC])->all();
            foreach ($daftar_obyek as $daftar_obyek) {
                $obyek_lelang = $daftar_obyek->obyek_lelang;
                $id_obyek = $daftar_obyek->id;

                $letak_tanah_bangunan = $daftar_obyek->letak_tanah_bangunan;
                $status_tanah_bangunan = $daftar_obyek->status_tanah_bangunan;
                $nama_debitur = $daftar_obyek->nama_debitur;
                $npwp_debitur = $daftar_obyek->npwp_debitur;
                $alamat_debitur = $daftar_obyek->alamat_debitur;
                $luas_tanah = $daftar_obyek->luas_tanah;
                $luas_bangunan = $daftar_obyek->luas_bangunan;
                $nop = $daftar_obyek->nop;
                $kab_kota = $daftar_obyek->kab_kota;
                $id_jenis = $daftar_obyek->id_jenis;
                    if ($id_jenis) {
                        $daftar_jenis = LelangObyekJenis::find()
                        ->select(['*'])
                        ->where(['id' => $id_jenis])
                        ->one();
                        $uraian = $daftar_jenis->uraian;
                    }
                    else{
                        $uraian = '';
                    }
                if ($id_jenis == 1) {
                    $obyek_lelang = "Sebidang tanah seluas ".$luas_tanah." m2, sesuai ".$status_tanah_bangunan." an. ".$nama_debitur." terletak di ".$letak_tanah_bangunan;
                }
                elseif ($id_jenis == 2) {
                    $obyek_lelang = "Sebuah bangunan seluas ".$luas_bangunan." m2, sesuai ".$status_tanah_bangunan." an. ".$nama_debitur." terletak di ".$letak_tanah_bangunan;
                }
                elseif ($id_jenis == 3) {
                    $obyek_lelang = "Sebidang tanah berikut bangunan seluas ".$luas_tanah." m2, sesuai ".$status_tanah_bangunan." an. ".$nama_debitur." terletak di ".$letak_tanah_bangunan;
                }
                else{
                    $obyek_lelang = $obyek_lelang;
                }
                ?>
                <tr>
                    <td class="text-center"><?=$no_urut?>.</td>
                    <td><?=$obyek_lelang?></td>
                    <td class="text-center">
                        <?= Html::a('Pilih', ['add-rl', 'id_obyek' => $id_obyek, 'id_rl'=>$_GET['id_rl']], ['class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php
                $no_urut++;
            }
            ?>

        </tbody>
    </table>


</div>
