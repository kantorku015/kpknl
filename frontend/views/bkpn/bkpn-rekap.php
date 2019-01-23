<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Bkpn;
use frontend\models\Bulan;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BkpnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rekap BKPN';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bkpn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a('<span class="glyphicon glyphicon-list-alt"></span> Lihat Seluruh Data', ['bkpn/index'], ['class' => 'btn btn-success']) ?>
    </p>

<ul class="nav nav-tabs">
  <!-- <li class="active"><a data-toggle="tab" href="#home">Home</a></li> -->
  <li class="active"><a data-toggle="tab" href="#menu1">Per PP</a></li>
  <li><a data-toggle="tab" href="#menu2">Per Tahun</a></li>
  <li><a data-toggle="tab" href="#menu3">Aktif/Inaktif</a></li>
</ul>

<div class="tab-content">
  <!-- <div id="home" class="tab-pane fade in active">
    <h3>HOME</h3>
    <p>Some content.</p>
  </div> -->

  <!-- =================================================== -->
  <!-- <div id="menu1" class="tab-pane fade"> -->
  <div id="menu1" class="tab-pane fade in active">
    <!-- <h3>Menu 1</h3> -->
    <h2>Daftar BKPN Per Penyerah Piutang</h2>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center bg-primary">No</th>
                <th class="text-center bg-primary">Penyerah Piutang</th>
                <th class="text-center bg-primary">Jumlah Berkas</th>
            </tr>
        </thead>


    <tbody>
    <?php
    #daftar penyerah piutang
    $no_pp = 1;
    $daftar_pp = Bkpn::find()
        ->select(['pp_nama'])
        ->distinct()
        ->orderBy(['pp_nama'=>SORT_ASC])->all();
    foreach ($daftar_pp as $daftar_pp) {
        $pp_nama = $daftar_pp->pp_nama;
        #hitung berkas per pp
        $count_berkas_pp = Bkpn::find()
            ->where(['pp_nama'=>$pp_nama])
            ->count();
        #hitung berkas all
        $count_berkas_all = Bkpn::find()
            // ->where(['pp_nama'=>$pp_nama])
            ->count();            
        ?>

            <tr>
                <td class="text-center"><?=$no_pp?>.</td>
                <td><?=$pp_nama?></td>
                <td class="text-center"><?=$count_berkas_pp?></td>
            </tr>
            <?php
            $no_pp++;
        }
            ?>
            <tr>
                <td class="text-center bg-primary" colspan="2">Jumlah</td>
                <td class="text-center bg-primary"><?=$count_berkas_all?></td>
            </tr>
        </tbody>

    </table>
  </div>
  <!-- =================================================== -->
  <div id="menu2" class="tab-pane fade">
  <!-- <div id="menu2" class="tab-pane fade in active"> -->
    <!-- <h3>Menu 2</h3> -->
    <h2>Daftar BKPN Per Tahun</h2>
    <p>Jumlah ini dihitung berdasarkan nomor register kasus.</p>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center bg-primary">Tahun</th>
                <?php
                #kolom bulan
                $daftar_bulan = Bulan::find()
                    ->select('*')
                    ->orderBy(['id_bulan'=>SORT_ASC])->all();
                foreach ($daftar_bulan as $daftar_bulan) {
                    $id_bulan = $daftar_bulan->id_bulan;
                    $nama_bulan = $daftar_bulan->nama;
                ?>
                <th class="text-center bg-primary"><?=$id_bulan?></th>
                <?php
                }
                ?>
                                   
                <th class="text-center bg-primary">Jumlah</th>
            </tr>
        </thead>

    <tbody>
    <?php
    #daftar tahun
    $no_tahun = 1;
    $daftar_tahun = Bkpn::find()
        ->select(['SUBSTRING(nrpn,1,4) nrpn'])
        ->distinct()
        ->orderBy(['nrpn'=>SORT_ASC])->all();
    foreach ($daftar_tahun as $daftar_tahun) {
        $tahun = $daftar_tahun->nrpn;
    ?>
            <tr>
                <td colspan="" class="text-center"><?=$tahun?></td>
            <?php
                #kolom bulan
                $daftar_bulan = Bulan::find()
                    ->select('*')
                    ->orderBy(['id_bulan'=>SORT_ASC])->all();
                foreach ($daftar_bulan as $daftar_bulan) {
                    $id_bulan = $daftar_bulan->id_bulan;
                    $nama_bulan = $daftar_bulan->nama;
                    #hitung jumlah berkas per bulan
                    $count_berkas_per_bulan = Bkpn::find()
                        ->where(['SUBSTRING(nrpn,1,4)'=>$tahun])
                        ->andWhere(['SUBSTRING(nrpn,5,2)'=>$id_bulan])
                        ->count();
                    if ($count_berkas_per_bulan == 0) {
                        $count_berkas_per_bulan = "-";
                    }
                    else{
                        $count_berkas_per_bulan = $count_berkas_per_bulan;
                    }
                ?>
                <td class="text-center"><?=$count_berkas_per_bulan?></td>
                <?php
                }
                #hitung jumlah berkas per tahun
                $count_berkas_per_tahun = Bkpn::find()
                    ->where(['SUBSTRING(nrpn,1,4)'=>$tahun])
                    ->count();
                ?>
                <td class="text-center"><b><?=$count_berkas_per_tahun?></b></td>
            </tr>
            <?php
            $no_tahun++;
        }
            #hitung jumlah berkas seluruhnya
            $count_berkas_all = Bkpn::find()
                // ->where(['SUBSTRING(nrpn,1,4)'=>$tahun])
                ->count();
            ?>
            <tr>
                
                <td class="text-center bg-primary" colspan="13"><b>Jumlah Seluruh Berkas</b></td>
                <td class="text-center bg-primary"><b><?=$count_berkas_all?></b></td>
            </tr>
        </tbody>
    </table>
  </div>

  <!-- =================================================== -->
  <div id="menu3" class="tab-pane fade">
  <!-- <div id="menu2" class="tab-pane fade in active"> -->
    <!-- <h3>Menu 2</h3> -->
    <h2>Daftar BKPN Per Tahun (Aktif/Inaktif)</h2>
    <p>Jumlah ini dihitung berdasarkan nomor register kasus.</p>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center bg-primary" width="200">Tahun</th>
                <th class="text-center bg-primary" width="100">Aktif</th>
                <th class="text-center bg-primary" width="100">Inaktif</th>
                <th class="text-center bg-primary" width="100">Jumlah</th>
            </tr>
        </thead>

    <tbody>
    <?php
    #daftar tahun
    $no_tahun = 1;
    $daftar_tahun = Bkpn::find()
        ->select(['SUBSTRING(nrpn,1,4) nrpn'])
        ->distinct()
        ->orderBy(['nrpn'=>SORT_ASC])->all();
    foreach ($daftar_tahun as $daftar_tahun) {
        $tahun = $daftar_tahun->nrpn;
        #hitung jumlah berkas per tahun aktif
        $count_berkas_per_tahun_aktif = Bkpn::find()
            ->where(['SUBSTRING(nrpn,1,4)'=>$tahun])
            ->andWhere(['status'=>1])
            ->count();
        #hitung jumlah berkas per tahun in aktif
        $count_berkas_per_tahun_inaktif = Bkpn::find()
            ->where(['SUBSTRING(nrpn,1,4)'=>$tahun])
            ->andWhere(['status'=>2])
            ->count();
        #hitung jumlah berkas per tahun
        $count_berkas_per_tahun = Bkpn::find()
            ->where(['SUBSTRING(nrpn,1,4)'=>$tahun])
            ->count();
        #hitung jumlah all aktif
        $count_berkas_aktif = Bkpn::find()
            ->where(['status'=>1])
            ->count();
        #hitung jumlah all in aktif
        $count_berkas_inaktif = Bkpn::find()
            ->where(['status'=>2])
            ->count();
        #hitung jumlah berkas seluruhnya
        $count_berkas_all = Bkpn::find()
            // ->where(['SUBSTRING(nrpn,1,4)'=>$tahun])
            ->count();
    ?>
            <tr>
                <td colspan="" class="text-center"><?=$tahun?></td>
                <td colspan="" class="text-center"><?= $count_berkas_per_tahun_aktif?></td>
                <td colspan="" class="text-center"><?= $count_berkas_per_tahun_inaktif?></td>
                <td colspan="" class="text-center"><?= $count_berkas_per_tahun?></td>
            </tr>
            <?php
            $no_tahun++;
        }
            ?>
            <tr>
                
                <td class="text-center bg-primary" colspan=""><b>Jumlah Seluruh Berkas</b></td>
                <td class="text-center bg-primary"><b><?=$count_berkas_aktif?></b></td>
                <td class="text-center bg-primary"><b><?=$count_berkas_inaktif?></b></td>
                <td class="text-center bg-primary"><b><?=$count_berkas_all?></b></td>
            </tr>
        </tbody>
    </table>
    </div></div>
</div>
</div>

</div>
