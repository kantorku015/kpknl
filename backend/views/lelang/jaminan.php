<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use backend\models\LelangHeader;
use backend\models\LelangUangJaminan;
use backend\models\LelangStakeholder;
use backend\models\LelangStatusProgres;
use backend\models\LelangStatusPeserta;
$this->title = 'Monitoring Uang Jaminan';
$this->params['breadcrumbs'][] = ['label' => 'Penatausahaan Lelang', 'url' => ['lelang/index']];
$this->params['breadcrumbs'][] = $this->title;

if (isset($_POST['status'])) {
	$status = $_POST['status'];
}
else {
	$status = "Semua";
}
?>
<h1><?= Html::encode($this->title) ?></h1>

<hr>
<div  class="container container-fluid row" align="left">
	<?= Html::beginForm('','post',['class' => 'form-inline'])?>
	<div class="row">
	<div class="col-md-12">
		<select class="form-control" name="status">
			<option><?= $status ?></option>
			<?php
			if ($status == "Belum") {
				$status2 = "Semua";
			}
			else{
				$status2 = "Belum";
			}
			?>
			<option><?= $status2 ?></option>
			<!-- <option>Semua</option>
			<option>Belum</option> -->
		</select>
		<?= Html::submitButton('<span class="glyphicon glyphicon-ok"> </span>',['class' => 'btn btn-success']) ?>
	</div>	
	</div>
	<?= Html::endForm()?>
</div>
<br>
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center bg-primary">No</th>
            <th class="text-center bg-primary">Obyek Lelang / Daftar Penyetor</th>
            <th class="text-center bg-primary">Jumlah Setor</th>
            <th class="text-center bg-primary">Tanggal Setor</th>
            <th class="text-center bg-primary">Tanggal Pengembalian</th>
        </tr>
    </thead>


    <tbody>
    <?php
    #daftar tempat sidang
    $no_lelang = 1;
    if ($status == "Belum") {
    	$daftar_lelang = LelangUangJaminan::find()
        ->select(['id_lelang'])
        ->distinct()
        ->where(['tgl_kembali' => null])
        // ->andWhere(['is not', ['tgl_kembali' => null]])
        ->orderBy(['id'=>SORT_ASC])->all();
    }
    else{
	    $daftar_lelang = LelangUangJaminan::find()
        ->select(['id_lelang'])
        ->distinct()
        ->orderBy(['id'=>SORT_ASC])->all();
	}

	// $daftar_lelang = LelangUangJaminan::find()
 //        ->select(['id_lelang'])
 //        ->distinct()
 //        // ->where(['tgl_kembali' => ""])
 //        ->andWhere(['tgl_kembali' => null])
 //        ->orderBy(['id'=>SORT_ASC])->all();

    foreach ($daftar_lelang as $daftar_lelang) {
    	$id_lelang = $daftar_lelang->id_lelang;
    		$data_lelang = LelangHeader::find()
		        ->select(['*'])
		        ->where(['id' => $id_lelang])
		        ->one();
    			$uraian_barang = $data_lelang->uraian_barang;
    			$progres = $data_lelang->progres;
		    		$data_progres = LelangStatusProgres::find()
				        ->select(['*'])
				        ->where(['id' => $progres])
				        ->one();
				        $progres = $data_progres->ur_status
    ?>
    	<tr>
    		<td colspan=""><?= $no_lelang ?></td>
    		<td colspan="4"><?= $uraian_barang ?><br><kbd><?= $progres?></kbd></td>
    	</tr>
    	<?php
    	$no_jaminan = 1;
    	$daftar_jaminan = LelangUangJaminan::find()
        ->select(['*'])
        ->where(['id_lelang' => $id_lelang])
        ->orderBy(['id_lelang'=>SORT_ASC])->all();
	    foreach ($daftar_jaminan as $daftar_jaminan) {
	    	$id_setoran = $daftar_jaminan->id;
            $peserta = $daftar_jaminan->peserta;
	    	$status_peserta = $daftar_jaminan->status;
	    		$data_peserta = LelangStakeholder::find()
    		        ->select(['*'])
    		        ->where(['id' => $peserta])
    		        ->one();
    		        $nama_peserta = $data_peserta->nama;
                $data_status = LelangStatusPeserta::find()
                    ->select(['*'])
                    ->where(['id' => $status_peserta])
                    ->one();
                    $status_peserta = $data_status->ur_status;
    		$jml_jaminan = $daftar_jaminan->jml_jaminan;
    		$tgl_setor = $daftar_jaminan->tgl_setor;
    		$tgl_kembali = $daftar_jaminan->tgl_kembali;
	    ?>
    	<tr>
    		<td></td>
    		<td><?= $no_jaminan ?>. <?= $nama_peserta?> | <?= $status_peserta ?></td>
    		<td class="text-right"><?= number_format($jml_jaminan,0,",",".")?></td>
    		<td class="text-center"><?= $tgl_setor?></td>
    		<td class="text-center">
    		<?php
    		if ($tgl_kembali == null) {
    		?>
    			<a href="../lelang-uang-jaminan/update2?id=<?= $id_setoran?>" class="btn btn-success" role="button">Tgl Kembali</a>
    		<?php
    		}
    		else{
    			echo $tgl_kembali;
    		}
    		?>

    		</td>
    	</tr>
    	<?php
    		$no_jaminan++;
    	}
        $no_lelang++;
    }
        ?>
	</tbody>
</table>