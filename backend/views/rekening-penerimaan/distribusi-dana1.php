<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\RekeningPenerimaan;
use backend\models\RekeningJenisTrn;
use backend\models\RekeningSaldoAwal;
use backend\models\LelangObyek;
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
<a href="daftar-trx">Daftar Transaksi</a>
|
<a href="per-trx">Per Jenis Transaksi</a>
|
<a href="distribusi-dana">Distribusi Dana</a>
|
</p>

<?php
// $no_trn = 1;
// $daftar_jns_trn = RekeningPenerimaan::find()
// ->select(['jns_trn'])
// ->distinct()
// ->all();
// foreach ($daftar_jns_trn as $daftar_jns_trn) {
// 	$jns_trn = $daftar_jns_trn->jns_trn;
// 	$data_jns_trn = RekeningJenisTrn::find()
// 	->select(['*'])
// 	->where(['id'=>$jns_trn])
// 	->one();
// 	$ur_trn = $data_jns_trn->ur_trn;
// 	echo $no_trn.". ";
// 	echo $ur_trn;
// 	echo "<br>";
// 	$no_trn++;
// }

?>

<?php
$saldo_awal = RekeningSaldoAwal::find()
->select(['*'])
->where(['jns_trn'=>'LM00'])
->one();
$rph_saldo_awal = $saldo_awal->jumlah;
$tgl_saldo_awal = $saldo_awal->tgl;

$rph_credit = Yii::$app->db
    ->createCommand("SELECT sum(credit) 
        FROM rekening_penerimaan 
        where id_parent IS NULL
        ");
$jml_rph_credit = $rph_credit->queryScalar();
$rph_debit = Yii::$app->db
    ->createCommand("SELECT sum(debit) 
        FROM rekening_penerimaan 
        where id_parent IS NULL
        ");
$jml_rph_debit = $rph_debit->queryScalar();
$rph_saldo_akhir = $rph_saldo_awal + $jml_rph_credit - $jml_rph_debit;

$max_journal = RekeningPenerimaan::find()
->select('journal_no')
// ->where(['tgl'=>'$tgl_akhir'])
// ->where(['tgl'=>$tgl_akhir])
->orderBy(['id'=>SORT_DESC])
->one();
if ($max_journal) {
    $jurnal_terakhir = $max_journal->journal_no;
}
else{
    $max_journal = RekeningPenerimaan::find()
        ->select('journal_no')
        // ->where(['tgl'=>'$tgl_akhir'])
        // ->where(['tgl'=>$tgl_akhir])
        ->orderBy(['id'=>SORT_DESC])
        ->one();
    $jurnal_terakhir = $max_journal->journal_no;
    // $jurnal_terakhir = 'xxxxxx';
}
$max_tanggal = RekeningPenerimaan::find()
->select('tgl')
// ->where(['tgl'=>'$tgl_akhir'])
// ->where(['tgl'=>$tgl_akhir])
->orderBy(['id'=>SORT_DESC])
->one();
if ($max_tanggal) {
    $tgl_terakhir = $max_tanggal->tgl;
}
else{
    $max_tanggal = RekeningPenerimaan::find()
        ->select('tgl')
        // ->where(['tgl'=>'$tgl_akhir'])
        // ->where(['tgl'=>$tgl_akhir])
        ->orderBy(['id'=>SORT_DESC])
        ->one();
    $tgl_terakhir = $max_tanggal->tgl;
}

$min_tanggal = RekeningPenerimaan::find()
->select('tgl')
// ->where(['tgl'=>'$tgl_akhir'])
// ->where(['tgl'=>$tgl_akhir])
->orderBy(['id'=>SORT_ASC])
->one();
if ($min_tanggal) {
    $tgl_pertama = $min_tanggal->tgl;
}
else{
    $min_tanggal = RekeningPenerimaan::find()
        ->select('tgl')
        // ->where(['tgl'=>'$tgl_akhir'])
        // ->where(['tgl'=>$tgl_akhir])
        ->orderBy(['id'=>SORT_ASC])
        ->one();
    $tgl_pertama = $min_tanggal->tgl;
}
?>
<p>Saldo Awal (per<code><?=$tgl_pertama ?></code>): Rp<?=number_format($rph_saldo_awal,2,",",".") ?></p>
<p>
	Uang Masuk : Rp<?=number_format($jml_rph_credit,2,",",".") ?>
	<a data-toggle="collapse" data-target="#rincian_credit">terdiri dari</a>
	<div id="rincian_credit" class="collapse">
		<table class="table table-striped table-hover table-bordered">
		    <thead>
		        <tr>
		            <th class="text-center bg-primary">No</th>
		            <th class="text-center bg-primary">Jenis Transaksi</th>
		            <th class="text-center bg-primary">Rupiah</th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php
		        $array_rph = array();
				$no_trn = 1;
				$daftar_jns_trn = RekeningPenerimaan::find()
				->select(['jns_trn'])
				->distinct()
				->where(['like','jns_trn','M'])
				->all();
				foreach ($daftar_jns_trn as $daftar_jns_trn) {
					$jns_trn = $daftar_jns_trn->jns_trn;
						$data_jns_trn = RekeningJenisTrn::find()
						->select(['*'])
						->where(['id'=>$jns_trn])
						->one();
						$ur_trn = $data_jns_trn->ur_trn;
					$rph_jns_trn = Yii::$app->db
					    ->createCommand("SELECT sum(credit) 
					        FROM rekening_penerimaan 
					        where id_parent IS NULL
					        and jns_trn = '$jns_trn'
					        ");
					$jml_rph_jns_trn = $rph_jns_trn->queryScalar();
					
					?>
					<tr>
						<td><?=$no_trn;?>.</td>
						<td><?=$ur_trn;?></td>
						<td class="text-right"><?=number_format($jml_rph_jns_trn,2,",",".") ?></td>
					</tr>
					<?php
					array_push($array_rph,$jml_rph_jns_trn);
					$no_trn++;
				}
				$total_rph = array_sum($array_rph);
				?>
				<tr>
					<td class="bg-info text-center" colspan="2"><b>Jumlah Uang Masuk</b></td>
					<td class="bg-info text-right"><b><?=number_format($total_rph,2,",",".") ?></b></td>
				</tr>
		    </tbody>
		</table>
	</div>
</p>
<p>Uang Keluar : Rp<?=number_format($jml_rph_debit,2,",",".") ?>
	<a data-toggle="collapse" data-target="#rincian_debit">terdiri dari</a>
	<div id="rincian_debit" class="collapse">
		<table class="table table-striped table-hover table-bordered">
		    <thead>
		        <tr>
		            <th class="text-center bg-primary">No</th>
		            <th class="text-center bg-primary">Jenis Transaksi</th>
		            <th class="text-center bg-primary">Rupiah</th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php
		        $array_rph = array();
				$no_trn = 1;
				$daftar_jns_trn = RekeningPenerimaan::find()
				->select(['jns_trn'])
				->distinct()
				->where(['like','jns_trn','K'])
				->all();
				foreach ($daftar_jns_trn as $daftar_jns_trn) {
					$jns_trn = $daftar_jns_trn->jns_trn;
						$data_jns_trn = RekeningJenisTrn::find()
						->select(['*'])
						->where(['id'=>$jns_trn])
						->one();
						$ur_trn = $data_jns_trn->ur_trn;
					$rph_jns_trn = Yii::$app->db
					    ->createCommand("SELECT sum(debit) 
					        FROM rekening_penerimaan 
					        where id_parent IS NULL
					        and jns_trn = '$jns_trn'
					        ");
					$jml_rph_jns_trn = $rph_jns_trn->queryScalar();
					
					?>
					<tr>
						<td><?=$no_trn;?>.</td>
						<td><?=$ur_trn;?></td>
						<td class="text-right"><?=number_format($jml_rph_jns_trn,2,",",".") ?></td>
					</tr>
					<?php
					array_push($array_rph,$jml_rph_jns_trn);
					$no_trn++;
				}
				$total_rph = array_sum($array_rph);
				?>
				<tr>
					<td class="bg-info text-center" colspan="2"><b>Jumlah Uang Keluar</b></td>
					<td class="bg-info text-right"><b><?=number_format($total_rph,2,",",".") ?></b></td>
				</tr>
		    </tbody>
		</table>
	</div>
</p>
<p>Saldo Akhir (per<code><?=$tgl_terakhir ?></code>): Rp<?=number_format($rph_saldo_akhir,2,",",".") ?></p>
    Jurnal Terakhir: <kbd><?=$jurnal_terakhir ?></kbd>
    Tanggal: <code><?=$tgl_terakhir?></code>
</p>


<h2>A. Lelang</h2>
<ol>
	<h3><li>Permohonan</li></h3>
	...
	<h3><li>Uang Jaminan</li></h3>
	<h3>
		<li data-toggle="collapse" data-target="#tab_laku">Laku</li>
	</h3>

	<div id="tab_laku" class="collapse">
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#balance">Sudah Balance</a></li>
		  <li><a data-toggle="tab" href="#belum">Belum Balance</a></li>
		</ul>

		<div class="tab-content">
		  <div id="balance" class="tab-pane fade in active">
		    <h3>Sudah Balance</h3>
		    <p data-toggle="collapse" data-target="#lelang_laku">daftar transaksi yang sudah lengkap.</p>
		  </div>
		  <div id="belum" class="tab-pane fade">
		    <h3>Belum Balance</h3>
		    <p>daftar transaksi yang belum.</p>
		  </div>
		</div>

	<div id="lelang_laku" class="collapse">
		<ol>
			<?php
			$no=1;
			$daftar_rl_laku = LelangObyek::find()
			->select(['*'])
			->where(['status_lelang'=>2])
			->orderBy(['rl_no'=>SORT_ASC])
			->all();
			foreach ($daftar_rl_laku as $daftar_rl_laku) {
				$rl_no = $daftar_rl_laku->rl_no;
				?>
					<li>
						<table class="table table-striped table-hover table-bordered">
							<thead>
								<th class="text-center bg-primary">Transaksi</th>
								<th class="text-center bg-primary">Uang Masuk</th>
								<th class="text-center bg-primary">Uang Keluar</th>
							</thead>
						<?php
						echo $rl_no;
						echo "<br>";
							#daftar rl di rek korang
							$array_credit = array();
							$array_debit = array();
							$daftar_trx_laku = RekeningPenerimaan::find()
							->select(['*'])
							->where(['no_dokumen'=>$rl_no])
							->orderBy(['id'=>SORT_ASC])
							->all();
							foreach ($daftar_trx_laku as $daftar_trx_laku) {
								$jns_trn = $daftar_trx_laku->jns_trn;
								$credit = $daftar_trx_laku->credit;
								$debit = $daftar_trx_laku->debit;
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
					</li>
				<?php
				$no++;
			}
			?>
		</ol>
	</div>
	</div>
	<h3><li>Batal</li></h3>
	<h3><li>Wanprestasi</li></h3>
</ol>
<h2>B. Piutang</h2>


</div>
