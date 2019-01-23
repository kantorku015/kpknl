<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use backend\models\IkuHeader;
$this->title = 'PENGELOLAAN INDIKATOR KINERJA UTAMA';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<!-- <h2>Proses Penatausahaan Lelang</h2> -->
<hr>
<!-- <h3> -->
<ol class="list-group">
	<li class="list-group-item"><b>Indikator Kinerja Utama</b>
	<p>- Pengelolaan IKU dimulai dengan merekam <a href="../iku-ss/index"><span class="glyphicon glyphicon-briefcase"></span> Sasaran Strategis</a>.</p>
	<p>- Kemudian rekam <a href="../iku-header/index"><span class="glyphicon glyphicon-star"></span> IKU</a> sesuai SS terkait.</p>
	<p>- Tentukan PIC terkait IKU sesuai kontribusi masing-masing <a href="../iku-pic/index"><span class="glyphicon glyphicon-user"></span> seksi</a>.</p>
	</li>
		<!-- <li class="list-group-item list-group-item-success"><a href="../iku-ss/index"><span class="glyphicon glyphicon-th-list"></span> Daftar Sasaran Strategis</a></li> -->
<!-- <hr>
	<li class="list-group-item"><b>Target dan Capaian IKU</b>
	<p>- Perekaman <a href="../iku-target/index"><span class="glyphicon glyphicon-pencil"></span> target IKU</a>.
	<p>- Perekaman <a href="../iku-capaian/index"><span class="glyphicon glyphicon-pencil"></span> capaian IKU</a>.
	</li> -->
		<!-- <li class="list-group-item list-group-item-success"><a href="../iku-header/index"><span class="glyphicon glyphicon-th-list"></span> Daftar IKU</a></li> -->
<hr>
		<li class="list-group-item"><b>Laporan IKU</b>
	<p>Laporan IKU untuk pemantauan oleh Kepala Kantor dan MKO
	</li>
		<li class="list-group-item list-group-item-success">
			<!-- <a href="../iku/report" class="btn btn-success">
				<span class="glyphicon glyphicon-print"></span> Lihat Laporan
			</a> -->
			<?php
			$daftar_tahun = IkuHeader::find()
			->select(['tahun'])
			->distinct()
			->all();
			foreach ($daftar_tahun as $daftar_tahun) {
				$tahun = $daftar_tahun->tahun;
				// echo $tahun;
				?>
				<a href="../iku/report?tahun=<?=$tahun?>" class="btn btn-success">
					<span class="glyphicon glyphicon-list"></span> <?=$tahun?>
				</a>
				<?php
			}
			?>
		</li>
<hr>
</ol>
<hr>
<!-- </h3> -->
<h3>Daftar Referensi</h3>
<p><a class="btn btn-default" href="../iku-jenis/index">Jenis IKU &raquo;</a>
<a class="btn btn-default" href="../iku-satuan/index">Satuan IKU &raquo;</a>
<a class="btn btn-default" href="../iku-target/index">Target IKU &raquo;</a>
<a class="btn btn-default" href="../iku-capaian/index">Capaian IKU &raquo;</a>
