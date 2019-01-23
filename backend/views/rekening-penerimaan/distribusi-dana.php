<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\RekeningPenerimaan;
use backend\models\RekeningJenisTrn;
use backend\models\RekeningSaldoAwal;
use backend\models\LelangObyek;
use backend\models\DokSummary;
use backend\models\DokSummaryLengkap;
use backend\models\DokSummaryBelumLengkap;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LelangRekeningSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Distribusi Dana';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-rekening-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
<a href="daftar-trx">Rekening Koran</a>
|
<a href="per-trx">Per Jenis Transaksi</a>
|
</p>



<?php
#hitung lengkap
$daftar_dok_lengkap = DokSummary::find()
->select(['*'])
->where(['saldo'=>0])
->count();
#hitung belum lengkap
$daftar_dok_belum_lengkap = DokSummary::find()
->select(['*'])
->where(['<>','saldo',0])
->count();
#hitung rph belum lengkap
$rph_belum_lengkap = Yii::$app->db
->createCommand("SELECT sum(saldo) 
    FROM dok_summary 
    -- where id_parent IS NULL
    ");
$jml_rph_belum_lengkap = $rph_belum_lengkap->queryScalar();
#hitung kosong
$daftar_dok_kosong = RekeningPenerimaan::find()
->select(['*'])
->where(['no_dokumen'=>''])
->orWhere(['no_dokumen'=>'0'])
->count();
// #hitung credit trx yang kosong no dok
// $rph_credit_kosong = Yii::$app->db
// ->createCommand("SELECT sum(credit) 
//     FROM rekening_penerimaan 
//     where no_dokumen = '0'
//     or no_dokumen = ''
//     ");
// $jml_rph_credit_kosong = $rph_credit_kosong->queryScalar();
// #hitung debit trx yang kosong no dok
// $rph_debit_kosong = Yii::$app->db
// ->createCommand("SELECT sum(debit) 
//     FROM rekening_penerimaan 
//     where no_dokumen = '0'
//     or no_dokumen = ''
//     ");
// $jml_rph_debit_kosong = $rph_debit_kosong->queryScalar();
?>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#lengkap">Lengkap <span class="label label-success"><?=$daftar_dok_lengkap?></span></a></li>
  <li><a data-toggle="tab" href="#belum">Belum Lengkap <span class="label label-warning"><?=$daftar_dok_belum_lengkap?></span></a></li>
  <li><a data-toggle="tab" href="#kosong">Kosong <span class="label label-danger"><?=$daftar_dok_kosong?></span></a></li>
</ul>

<div class="tab-content">
  
  <div id="lengkap" class="tab-pane fade in active">
    <h3 class="bg-success">Daftar Transaksi Yang Sudah Lengkap</h3>
    <button class="btn btn-info" data-toggle="collapse" data-target="#daftar_lengkap">Tampilkan</button>
	<div id="daftar_lengkap" class="collapse">
	<!-- Daftar transaksi yang sudah lengkap -->
	<br>
	<?php
	$no=1;
	$daftar_dok = DokSummary::find()
	// $daftar_dok = DokSummaryLengkap::find()
	->select(['*'])
	->where(['saldo'=>0])
	->all();
	foreach ($daftar_dok as $daftar_dok) {
		$no_dokumen = $daftar_dok->no_dokumen;
		// echo $no_dokumen;
		// echo "<br>";
		?>
	<p class="btn btn-success" data-toggle="collapse" data-target="#daftar_lengkap_rinci<?=$no?>"><?=$no.". ".$no_dokumen?></p>
	<div id="daftar_lengkap_rinci<?=$no?>" class="collapse">
			<table class="table table-striped table-hover table-bordered">
				<thead>
					<th class="text-center bg-primary">Transaksi</th>
					<th class="text-center bg-primary">Uang Masuk</th>
					<th class="text-center bg-primary">Uang Keluar</th>
				</thead>
				<?php
				$array_credit = array();
				$array_debit = array();
				$daftar_trx = RekeningPenerimaan::find()
				->select(['*'])
				->where(['no_dokumen'=>$no_dokumen])
				->orderBy(['id'=>SORT_ASC])
				->all();
				foreach ($daftar_trx as $daftar_trx) {
					$jns_trn = $daftar_trx->jns_trn;
					$credit = $daftar_trx->credit;
					$debit = $daftar_trx->debit;
						$data_jns_trn = RekeningJenisTrn::find()
							->select(['*'])
							->where(['id'=>$jns_trn])
							->one();
							$ur_trn = $data_jns_trn->ur_trn;
					array_push($array_credit, $credit);
					array_push($array_debit, $debit);
					?>
						<tr>
							<td><?=$ur_trn?></td>
							<td class="text-right">
								<?php
								if ($credit == 0) {
									echo "";
								}
								else{
									echo number_format($credit,2,",",".");
								}
								?>
							</td>
							<td class="text-right">
								<?php
								if ($debit == 0) {
									echo "";
								}
								else{
									echo number_format($debit,2,",",".");
								}
								?>
							</td>
						</tr>
					<?php
				}
				$total_credit = array_sum($array_credit);
				$total_debit = array_sum($array_debit);
			?>
						<tr>
							<th class="text-center bg-info">Jumlah</th>
							<th class="text-right bg-info"><?=number_format($total_credit,2,",",".");?></th>
							<th class="text-right bg-info"><?=number_format($total_debit,2,",",".");?></th>
						</tr>
					</table>
				</div>
	<?php
	$no++;
	}
	?>
	</div>
  </div>

  <div id="belum" class="tab-pane fade">
    <h3 class="bg-warning">Daftar Transaksi Yang Belum Lengkap</h3>
    <button class="btn btn-info" data-toggle="collapse" data-target="#daftar_belum_lengkap">Tampilkan</button>
	<div id="daftar_belum_lengkap" class="collapse">
	<!-- Daftar transaksi yang belum lengkap -->
	<br>
	<!-- <br> -->
	<?php
	$no=1;
	$daftar_dok = DokSummary::find()
	// $daftar_dok = DokSummaryBelumLengkap::find()
	->select(['*'])
	->where(['<>','saldo',0])
	->all();
	foreach ($daftar_dok as $daftar_dok) {
		$no_dokumen = $daftar_dok->no_dokumen;
		// echo $no.". ".$no_dokumen;
		// echo "<br>";
		?>
	<p class="btn btn-warning" data-toggle="collapse" data-target="#daftar_belum_lengkap_rinci<?=$no?>"><?=$no.". ".$no_dokumen?></p>
	<div id="daftar_belum_lengkap_rinci<?=$no?>" class="collapse">
			<table class="table table-striped table-hover table-bordered">
				<thead>
					<th class="text-center bg-primary">Transaksi Dokumen Nomor <?=$no_dokumen ?></th>
					<th class="text-center bg-primary">Uang Masuk</th>
					<th class="text-center bg-primary">Uang Keluar</th>
				</thead>
				<?php
				$array_credit = array();
				$array_debit = array();
				$daftar_trx = RekeningPenerimaan::find()
				->select(['*'])
				->where(['no_dokumen'=>$no_dokumen])
				->orderBy(['id'=>SORT_ASC])
				->all();
				foreach ($daftar_trx as $daftar_trx) {
					$jns_trn = $daftar_trx->jns_trn;
					$credit = $daftar_trx->credit;
					$debit = $daftar_trx->debit;
						$data_jns_trn = RekeningJenisTrn::find()
							->select(['*'])
							->where(['id'=>$jns_trn])
							->one();
							$ur_trn = $data_jns_trn->ur_trn;
					array_push($array_credit, $credit);
					array_push($array_debit, $debit);
					?>
						<tr>
							<td><?=$ur_trn?></td>
							<td class="text-right">
								<?php
								if ($credit == 0) {
									echo "";
								}
								else{
									echo number_format($credit,2,",",".");
								}
								?>
							</td>
							<td class="text-right">
								<?php
								if ($debit == 0) {
									echo "";
								}
								else{
									echo number_format($debit,2,",",".");
								}
								?>
							</td>
						</tr>
					<?php
				}
				$total_credit = array_sum($array_credit);
				$total_debit = array_sum($array_debit);
			?>
						<tr>
							<th class="text-center bg-info">Jumlah</th>
							<th class="text-right bg-info"><?=number_format($total_credit,2,",",".");?></th>
							<th class="text-right bg-info"><?=number_format($total_debit,2,",",".");?></th>
						</tr>
					</table>
		</div>
	<?php
	$no++;
	}
	?>
	</div>
  </div>

  <div id="kosong" class="tab-pane fade">
    <h3 class="bg-danger">Daftar Transaksi Tanpa Nomor Dokumen</h3>
    <button class="btn btn-info" data-toggle="collapse" data-target="#daftar_tanpa_no_dokumen">Tampilkan</button>
	<div id="daftar_tanpa_no_dokumen" class="collapse">
	Daftar transaksi tanpa nomor dokumen, lihat pada <a href="per-trx">Daftar Transaksi berikut ini</a>
	</div>
  </div>

</div>




</div>
