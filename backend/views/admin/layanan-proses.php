<?php
use backend\models\KpknlStruktur;
use backend\models\KpknlLayanan;
use backend\models\KpknlLayananProses;
use yii\helpers\Html;
$this->title = 'SLP';

if (isset($_GET['id'])) {
	$id_href = $_GET['id'];
}
else{
	$id_href = '';
}
?>
<h1>Struktur Organisasi, Layanan, dan Proses</h1>

<?php
// LEVEL 1: SEKSI
$data_seksi = KpknlStruktur::find()
	->select(['*'])
	->orderBy(['id'=>SORT_ASC])
	->all();
	foreach ($data_seksi as $data_seksi) {
		$id_seksi = $data_seksi->id;
			$dataTarget1 = $id_seksi;
		$ur_seksi = $data_seksi->ur_seksi;
		$ur_seksi_singk = $data_seksi->ur_seksi_singk;
		?>
		<div class="text-danger" data-toggle="collapse" data-target="#<?=$dataTarget1?>"><i class="fa fa-bookmark"></i> <?=$ur_seksi?></div>
			<div id="<?=$dataTarget1?>" class="collapse in" data-toggle="collapse">
			<?php
			#data layanan pada seksi ini
			// LEVEL 2: LAYANAN
			$data_layanan = KpknlLayanan::find()
				->select(['*'])
				->where(['id_seksi'=>$id_seksi])
				->orderBy(['id'=>SORT_ASC])
				->all();
				foreach ($data_layanan as $data_layanan) {
					$id_layanan = $data_layanan->id;
						$dataTarget2 = $dataTarget1.$id_layanan;
					$ur_layanan = $data_layanan->ur_layanan;
					if ($id_href == $dataTarget2) {
						$open = "in";
					}
					else{
						$open = '';
					}

					// echo $ur_layanan."<br>";
					?>
					<div class="text-success " data-toggle="collapse" data-target="#<?=$dataTarget2?>">&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-check-circle"></i> <?=$ur_layanan?></div>
						<div id="<?=$dataTarget2?>" class="collapse <?=$open?>" data-toggle="collapse"> <a id=<?=$dataTarget2?>></a>
						<?php
						#data proses pada layanan ini
						// LEVEL 3: PROSES
						$data_proses = KpknlLayananProses::find()
							->select(['*'])
							->where(['id_layanan'=>$id_layanan])
							->orderBy(['id'=>SORT_ASC])
							->all();
							foreach ($data_proses as $data_proses) {
								$id_proses = $data_proses->id;
									$dataTarget3 = $dataTarget2.$id_proses;
								$ur_proses = $data_proses->ur_proses;
								?>
								<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-check"></i> <?=$ur_proses?></div>
								<?php
							}
						?>
						<?= Html::a(
        				'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i> Proses', 
        				[
        					'kpknl-layanan-proses/create1',
        					'id_seksi' => $id_seksi,
        					'id_layanan' => $id_layanan,
        					'id_href' => $dataTarget2,
        					], 
        				[
        					'class' => 'btn btn-link',
        					'data' => [
        						// 'confirm' => 'Tambah Proses?',
        						'method' => 'post',
        						],
        					]
        				);
        			?>
						</div>
					<?php
				}
			?>
					<?= Html::a(
        				'<i class="fa fa-plus-circle"></i> Layanan', 
        				[
        					'kpknl-layanan/create1',
        					'id_seksi' => $id_seksi,
        					'id_href' => $dataTarget2
        					], 
        				[
        					'class' => 'btn btn-link',
        					'data' => [
        						// 'confirm' => 'Tambah Proses?',
        						'method' => 'post',
        						],
        					]
        				);
        			?>
			</div>
		<?php
	}
?>
<!-- <a class="collapsed" href="#23" data-toggle="collapse" data-target="#23"> 23 </a> -->