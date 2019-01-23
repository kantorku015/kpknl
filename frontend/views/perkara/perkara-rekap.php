<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Perkara;
// use frontend\models\Bkpn;
use frontend\models\Bulan;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BkpnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rekap Perkara';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bkpn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a('<span class="glyphicon glyphicon-list-alt"></span> Lihat Seluruh Data Perkara', ['perkara/index'], ['class' => 'btn btn-success']) ?>
    </p>

<ul class="nav nav-tabs">
  <!-- <li class="active"><a data-toggle="tab" href="#home">Home</a></li> -->
  <li class="active"><a data-toggle="tab" href="#menu1">Tempat Sidang</a></li>
  <li><a data-toggle="tab" href="#menu2">Per Tahun</a></li>
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
    <h2>Daftar Perkara Sesuai Tempat Sidang</h2>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center bg-primary">No</th>
                <th class="text-center bg-primary">Tempat Sidang</th>
                <th class="text-center bg-primary">Aktif</th>
                <th class="text-center bg-primary">Inaktif</th>
                <th class="text-center bg-primary">Jumlah Berkas</th>
            </tr>
        </thead>


    <tbody>
    <?php
    #daftar tempat sidang
    $no_tempat_sidang = 1;
    $daftar_tempat_sidang = Perkara::find()
        ->select(['tempat'])
        ->distinct()
        ->orderBy(['tempat'=>SORT_ASC])->all();
    foreach ($daftar_tempat_sidang as $daftar_tempat_sidang) {
        $tempat = $daftar_tempat_sidang->tempat;
        #hitung perkara per tempat aktif
        $count_perkara_tempat_aktif = Perkara::find()
            ->where(['tempat'=>$tempat])
            ->andWhere(['status'=>1])
            ->count();
        #hitung perkara per tempat inaktif
        $count_perkara_tempat_inaktif = Perkara::find()
            ->where(['tempat'=>$tempat])
            ->andWhere(['status'=>2])
            ->count();
        #hitung perkara per tempat
        $count_perkara_tempat = Perkara::find()
            ->where(['tempat'=>$tempat])
            ->count();
        #hitung perkara all aktif
        $count_perkara_all_aktif = Perkara::find()
            ->andWhere(['status'=>1])
            ->count();
        #hitung perkara all in aktif
        $count_perkara_all_inaktif = Perkara::find()
            ->andWhere(['status'=>2])
            ->count();
        #hitung perkara all
        $count_perkara_all = Perkara::find()
            ->count();            
        ?>

            <tr>
                <td class="text-center"><?=$no_tempat_sidang?>.</td>
                <td><?=$tempat?></td>
                <td class="text-center"><?=$count_perkara_tempat_aktif?></td>
                <td class="text-center"><?=$count_perkara_tempat_inaktif?></td>
                <td class="text-center"><b><?=$count_perkara_tempat?></b></td>
            </tr>
            <?php
            $no_tempat_sidang++;
        }
            ?>
            <tr>
                <td class="text-center bg-primary" colspan="2">Jumlah</td>
                <td class="text-center bg-primary"><?=$count_perkara_all_aktif?></td>
                <td class="text-center bg-primary"><?=$count_perkara_all_inaktif?></td>
                <td class="text-center bg-primary"><b><?=$count_perkara_all?></b><td>
            </tr>
        </tbody>

    </table>
  </div>
  <!-- =================================================== -->
  <div id="menu2" class="tab-pane fade">
  <!-- <div id="menu2" class="tab-pane fade in active"> -->
    <!-- <h3>Menu 2</h3> -->
    <h2>Daftar Perkara Per Tahun</h2>
    <p>Jumlah ini dihitung berdasarkan tahun kejadian perkara.</p>
    <div class="row">
    <div class="col-md-6">
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center bg-primary">No</th>
                <th class="text-center bg-primary">Tahun</th>
                <th class="text-center bg-primary">Aktif</th>
                <th class="text-center bg-primary">Inaktif</th>
                <th class="text-center bg-primary">Jumlah</th>
            </tr>
        </thead>

    <tbody>
    <?php
    #daftar tahun
    $no_tahun = 1;
    $daftar_tahun = Perkara::find()
        ->select('tahun')
        ->distinct()
        ->orderBy(['tahun'=>SORT_ASC])->all();
    foreach ($daftar_tahun as $daftar_tahun) {
        $tahun = $daftar_tahun->tahun;
    ?>
            <tr>
                <td colspan="" class="text-center"><?=$no_tahun?></td>
                <td colspan="" class="text-center"><?=$tahun?></td>
            <?php
                #hitung jumlah berkas per tahun aktif
                $count_perkara_per_tahun_aktif = Perkara::find()
                    ->where(['tahun'=>$tahun])
                    ->andWhere(['status'=>1])
                    ->count();
                #hitung jumlah berkas per tahun inaktif
                $count_perkara_per_tahun_inaktif = Perkara::find()
                    ->where(['tahun'=>$tahun])
                    ->andWhere(['status'=>2])
                    ->count();
                #hitung jumlah berkas per tahun
                $count_perkara_per_tahun = Perkara::find()
                    ->where(['tahun'=>$tahun])
                    ->count();
                ?>
                <td class="text-center"><?=$count_perkara_per_tahun_aktif?></td>
                <td class="text-center"><?=$count_perkara_per_tahun_inaktif?></td>
                <td class="text-center"><b><?=$count_perkara_per_tahun?></b></td>
            </tr>
            <?php
            $no_tahun++;
        }
            #hitung jumlah berkas seluruhnya
            $count_perkara_all = Perkara::find()
                // ->where(['SUBSTRING(nrpn,1,4)'=>$tahun])
                ->count();
            ?>
            <tr>
                
                <td class="text-center bg-primary" colspan="2"><b>Jumlah Seluruh Berkas</b></td>
                <td class="text-center bg-primary"><?=$count_perkara_all_aktif?></td>
                <td class="text-center bg-primary"><?=$count_perkara_all_inaktif?></td>
                <td class="text-center bg-primary"><b><?=$count_perkara_all?></b></td>
            </tr>
        </tbody>
    </table>
    </div>
  </div>
</div>

    

    

</div>
