<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use frontend\models\LelangHeader;
use frontend\models\LelangUangJaminan;
use frontend\models\LelangStakeholder;
use frontend\models\LelangStatusProgres;
$this->title = 'Monitoring Pelunasan';
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
            <th class="text-center bg-primary">Nomor & Tgl Risalah Lelang</th>
            <th class="text-center bg-primary">Jumlah Pelunasan</th>
            <th class="text-center bg-primary">Tanggal Pelunasan</th>
             
        </tr>
    </thead>


    <tbody>
    <?php
    #daftar lelang
    $no_lelang = 1;
    if ($status == "Belum") {
    	$daftar_lelang = LelangHeader::find()
        ->select(['id'])
        ->distinct()
        ->where(['jml_pelunasan' => 0])
        ->orderBy(['id'=>SORT_ASC])->all();
    }
    else{
	    $daftar_lelang = LelangHeader::find()
        ->select(['id'])
        ->distinct()
        ->orderBy(['id'=>SORT_ASC])->all();
	}

    foreach ($daftar_lelang as $daftar_lelang) {
    	$id_lelang = $daftar_lelang->id;
    		$data_lelang = LelangHeader::find()
		        ->select(['*'])
		        ->where(['id' => $id_lelang])
		        ->one();
    			$uraian_barang = $data_lelang->uraian_barang;
                $progres = $data_lelang->progres;
                $no_rl = $data_lelang->no_rl;
                $tgl_rl = $data_lelang->tgl_rl;
                    $data_progres = LelangStatusProgres::find()
                        ->select(['*'])
                        ->where(['id' => $progres])
                        ->one();
                        $progres = $data_progres->ur_status;
                $jml_pelunasan = $data_lelang->jml_pelunasan;
    			$tgl_pelunasan = $data_lelang->tgl_pelunasan;
            $daftar_jaminan = LelangUangJaminan::find()
                ->select(['*'])
                ->where(['id_lelang' => $id_lelang])
                ->andWhere(['status' => 2])
                ->one();
                if ($daftar_jaminan) {
                    # code...
                    $peserta = $daftar_jaminan->peserta;
                    $data_peserta = LelangStakeholder::find()
                        ->select(['*'])
                        ->where(['id' => $peserta])
                        ->one();
                        $nama_peserta = $data_peserta->nama;
                }
                else{
                    $nama_peserta = 'kosong';
                }
    ?>
    	<tr>
    		<td colspan=""><?= $no_lelang ?></td>
    		<td colspan="4"><?= $uraian_barang ?><br><kbd><?= $progres?></kbd></td>
    	</tr>
    	<tr>
    		<td></td>
    		<td><?= $nama_peserta?></td>
            <td class="text-center"><?= $no_rl?> tgl <?= $tgl_rl ?></td>
            <td class="text-center"><?= $jml_pelunasan?></td>
    		<td class="text-center"><?= $tgl_pelunasan?></td>
    	</tr>
    	<?php
        $no_lelang++;
    }
        ?>
	</tbody>
</table>