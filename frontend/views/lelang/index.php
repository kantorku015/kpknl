<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'PENATAUSAHAAN LELANG';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<!-- <h2>Proses Penatausahaan Lelang</h2> -->
<hr>
<!-- <h3> -->
<ol class="list-group">
	<li class="list-group-item"><b><span class="glyphicon glyphicon-lock"></span> Uang Jaminan</b>
	<p>- Penginputan uang jaminan dimulai dengan merekam <a href="../lelang-header/index"><span class="glyphicon glyphicon-pencil"></span> data lelang</a> terkait uang jaminan dimaksud.

	<br>- Pastikan anda telah merekam data <a href="../lelang-stakeholder/index"><span class="glyphicon glyphicon-user"></span> stakeholder</a> (penjual dan pembeli).
	<br>- Jika data lelang & stakeholder telah direkam, lakukan penginputan uang jaminan yang telah masuk ke dalam rekening penampungan.
	</p>
	<a href="../lelang-uang-jaminan/create" class="btn btn-success" role="button"><span class="glyphicon glyphicon-record"></span> Input Uang Jaminan</a>
	<a href="../lelang-header/index">Daftar all</a>
	</li>
		<li class="list-group-item list-group-item-success"><a href="../lelang/jaminan"><span class="glyphicon glyphicon-th-list"></span> Monitoring Penerimaan dan Pengembalian Uang Jaminan</a></li>
<hr>
	<li class="list-group-item"><b><span class="glyphicon glyphicon-credit-card"></span> Pelunasan Pembayaran</b>
	<p><a href="../lelang-header/index"><span class="glyphicon glyphicon-pencil"></span> Input data pelunasan:</a> Jumlah Pelunasan dan Tanggal Pelunasan</p>
	- Pastikan anda telah memilih salah satu <a href="../lelang/jaminan"> <span class="glyphicon glyphicon-user"></span> peserta </a>sebagai pemenang.
	</li>
	<li class="list-group-item list-group-item-danger"><a href="../lelang/pelunasan"><span class="glyphicon glyphicon-th-list"></span> Daftar peserta yang belum melakukan pelunasan.</a></li>
<hr>

	<li class="list-group-item"><b><span class="glyphicon glyphicon-folder-close"></span> Penyetoran Hasil Lelang</b></li>
		<li class="list-group-item list-group-item-info"><a href="../lelang-hitung/index"><span class="glyphicon glyphicon-th-list"></span> Daftar penyetoran yang dilakukan Bendahara Pengeluaran, meliputi: Bea Lelang, PPh Final, dan Hasil Bersih Lelang.</a></li>
</ol>
<hr>
<!-- </h3> -->
<h3>Daftar Referensi Lelang</h3>
<p><a class="btn btn-default" href="../lelang-status-progres/index">Progres &raquo;</a>
<a class="btn btn-default" href="../lelang-status-peserta/index">Status Peserta &raquo;</a>
<a class="btn btn-default" href="../lelang-pejabat/index">Pejabat Lelang &raquo;</a></p>
