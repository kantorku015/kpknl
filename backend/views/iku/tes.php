<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use backend\models\IkuSs;
use backend\models\IkuHeader;
use backend\models\IkuPic;
use backend\models\IkuTarget;
use backend\models\IkuCapaian;
use backend\models\KpknlStruktur;
$tahun = date('Y');

$this->title = 'LAPORAN INDIKATOR KINERJA UTAMA TAHUN '.$tahun;
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>



<table class="table table-striped table-hover table-bordered">
    <tbody>
        <tr>
            <th class="text-center" rowspan="2" style="vertical-align: middle">No</th>
            <th class="text-center" rowspan="2" style="vertical-align: middle">SS, IKU<br>Seksi Terkait</th>
            <th class="text-center" rowspan="2" style="vertical-align: middle">Target</th>
            <th class="text-center" colspan="7">Realisasi</th>
        </tr>
        <tr>
            <th class="text-center" colspan="">Q1</th>
            <th class="text-center" colspan="">Q2</th>
            <th class="text-center" colspan="">Smt 1</th>
            <th class="text-center" colspan="">Q3</th>
            <th class="text-center" colspan="">s.d Q3</th>
            <th class="text-center" colspan="">Q4</th>
            <th class="text-center" colspan="">Year</th>
        </tr>
    </tbody>

	<tbody>
	<?php
	$data_ss = IkuSs::find()
	->select(['*'])
	->where(['tahun'=>$tahun])
	->orderBy(['no_urut'=>SORT_ASC])
	->all();
	foreach ($data_ss as $data_ss) {
		$id_ss = $data_ss->id;
		$no_urut = $data_ss->no_urut;
		$ur_ss = $data_ss->ur_ss;
		?>
		<tr>
			<td class="text-center"><?=$no_urut?>.</td>
			<td colspan="9"><?=$ur_ss?></td>
		</tr>
		<?php
		$data_iku = IkuHeader::find()
		->select(['*'])
		->where(['id_ss'=>$id_ss])
		->andWhere(['tahun'=>$tahun])
		->orderBy(['id'=>SORT_ASC])
		->all();
		foreach ($data_iku as $data_iku) {
			$id_iku = $data_iku->id;
				
			$kd_iku = $data_iku->kd_iku;
			$ur_iku = $data_iku->ur_iku;
			?>
			<tr>
				<td></td>
				<td>
					[<?=$kd_iku?>]&nbsp;<?=$ur_iku?><br>
					<?php
					$data_pic = IkuPic::find()
						->select(['*'])
						->where(['id_head'=>$id_iku])
						->all();
						foreach ($data_pic as $data_pic) {
							$id_pic = $data_pic->id;
								$data_target = IkuTarget::find()
								->select(['*'])
								->where(['id_pic'=>$id_pic])
								->one();
								if($data_target){
									$target_q1 = $data_target->target_q1;
									$target_q2 = $data_target->target_q2;
									$target_q3 = $data_target->target_q3;
									$target_q4 = $data_target->target_q4;
								}
								else{
									$target_q1 = "0";
									$target_q2 = "0";
									$target_q3 = "0";
									$target_q4 = "0";
								}

								$data_capaian = Ikucapaian::find()
								->select(['*'])
								->where(['id_pic'=>$id_pic])
								->one();
								if($data_capaian){
									$capaian_q1 = $data_capaian->capaian_q1;
									$capaian_q2 = $data_capaian->capaian_q2;
									$capaian_q3 = $data_capaian->capaian_q3;
									$capaian_q4 = $data_capaian->capaian_q4;
								}
								else{
									$capaian_q1 = "0";
									$capaian_q2 = "0";
									$capaian_q3 = "0";
									$capaian_q4 = "0";
								}
							$seksi_pic = $data_pic->seksi_pic;
								$data_seksi = KpknlStruktur::find()
								->select(['*'])
								->where(['id'=>$seksi_pic])
								->one();
								$ur_seksi_singk = $data_seksi->ur_seksi_singk;
							$porsi_pic = $data_pic->porsi_pic;
							echo "<kbd>";
							echo $ur_seksi_singk;
							// echo ":";
							echo "</kbd>";
							echo "<code>";
							echo number_format($porsi_pic,0,",",".")."%";
							echo "</code>";
							echo "&nbsp;";
						}
					?>
				</td>
				<td class="text-center">
					<?php
					echo $target_q4
					?>
				</td>
				<td class="text-center">
					<?php
					echo $capaian_q1
					?>
				</td>
				<td class="text-center">
					<?php
					echo $capaian_q2
					?>
				</td>
				<td class="text-center">
					s1
				</td>
				<td class="text-center">
					<?php
					echo $capaian_q3
					?>
				</td>
				<td class="text-center">
					q3
				</td>
				<td class="text-center">
					<?php
					echo $capaian_q4
					?>
				</td>
				<td class="text-center">
					year
				</td>
			</tr>
			<?php
		}
	}

	?>
	</tbody>
</table>
