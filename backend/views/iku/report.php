<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use backend\models\IkuSs;
use backend\models\IkuHeader;
use backend\models\IkuPic;
use backend\models\IkuTarget;
use backend\models\IkuTargetHeader;
use backend\models\IkuCapaianHeader;
use backend\models\IkuCapaian;
use backend\models\KpknlStruktur;
use yii\widgets\ActiveForm;

if (isset($_GET['tahun'])) {
	$tahun = $_GET['tahun'];
}
else{
	$tahun = date('Y');
}

$this->title = 'LAPORAN INDIKATOR KINERJA UTAMA TAHUN '.$tahun;
$this->params['breadcrumbs'][] = $this->title;
?>

<h5 class="text-center" style="font-family: serif;"><b>RINCIAN TARGET DAN CAPAIAN KINERJA</b></h5>
<h5 class="text-center" style="font-family: serif;"><b>KEPALA KANTOR PELAYANAN KEKAYAAN NEGARA DAN LELANG BEKASI</b></h5>
<h5 class="text-center" style="font-family: serif;"><b>DIREKTORAT JENDERAL KEKAYAAN NEGARA TAHUN 2018</b></h5>
<br>

<?php
        echo Html::beginForm('cetak','post',['class' => 'form-inline', 'target' => '_blank']);
            echo Html::textInput('periode','',['class'=>'form-control required','type'=>'text', 'placeholder'=>'isi: Q1|Q2|Q3|Q4']);
            echo Html::textInput('tahun','',['class'=>'form-control required','type'=>'text', 'placeholder'=>'isi tahun']);
            echo Html::submitButton('<span class="glyphicon glyphicon-print"></span> Cetak',[
            	'class'=>'btn btn-default',
            	'target' => '_blank',
            	]);
        echo Html::endForm();
        ?>



<table class="table table-striped table-hover table-bordered tableFixHead" repeat_header="1">
    <theader>
        <tr>
            <th class="text-center bg-info" rowspan="2" style="vertical-align: middle">No</th>
            <th class="text-center bg-info" rowspan="2" style="vertical-align: middle">SS, IKU<br>Seksi Terkait</th>
            <th class="text-center bg-info" rowspan="2" style="vertical-align: middle">Target<br>
            	<button class="btn btn-default btn-sm">Q1</button>
            	<button class="btn btn-default btn-sm">Q2</button>
            	<button class="btn btn-default btn-sm">Q3</button>
            	<button class="btn btn-default btn-sm">Q4</button>
            </th>
            <th class="text-center bg-primary" colspan="7">Realisasi</th>
        </tr>
        <tr>
            <th class="text-center bg-info" colspan="">Q1</th>
            <th class="text-center bg-info" colspan="">Q2</th>
            <th class="text-center bg-info" colspan="">Smt 1</th>
            <th class="text-center bg-info" colspan="">Q3</th>
            <th class="text-center bg-info" colspan="">s.d Q3</th>
            <th class="text-center bg-info" colspan="">Q4</th>
            <th class="text-center bg-info" colspan="">Year</th>
        </tr>
    </theader>

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
			<td class="text-center bg-primary filterable-cell"><b><?=$no_urut?>.</b></td>
			<td colspan="9" class="bg bg-primary filterable-cell"><b><?=$ur_ss?></b></td>
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
				$id_href = $id_ss.$id_iku;
			?>
			<tr>
				<td class="bg bg-info filterable-cell">
					<a id=<?=$id_href?>> </a>
				</td>
				<td class="bg bg-info filterable-cell">
					[<?=$kd_iku?>]&nbsp;<?=$ur_iku?>
				</td>
				<td class="text-center bg-info">
					<?php
					#hitung rata-rata target q1
					$avg_target_q1 = Yii::$app->db
					    ->createCommand("SELECT avg(target_q1) 
					        FROM iku_target_header 
					        where id_header = $id_iku");
					$nilai_avg_target_q1 = $avg_target_q1->queryScalar();
					#hitung rata-rata target q2
					$avg_target_q2 = Yii::$app->db
					    ->createCommand("SELECT avg(target_q2) 
					        FROM iku_target_header 
					        where id_header = $id_iku");
					$nilai_avg_target_q2 = $avg_target_q2->queryScalar();
					#hitung rata-rata target q3
					$avg_target_q3 = Yii::$app->db
					    ->createCommand("SELECT avg(target_q3) 
					        FROM iku_target_header 
					        where id_header = $id_iku");
					$nilai_avg_target_q3 = $avg_target_q3->queryScalar();
					#hitung rata-rata target q4
					$avg_target_q4 = Yii::$app->db
					    ->createCommand("SELECT avg(target_q4) 
					        FROM iku_target_header 
					        where id_header = $id_iku");
					$nilai_avg_target_q4 = $avg_target_q4->queryScalar();
					?>
					<button class="btn btn-primary btn-sm"><?=$nilai_avg_target_q1?></button>&nbsp;
					<button class="btn btn-info btn-sm"><?=$nilai_avg_target_q2?></button>&nbsp;
					<button class="btn btn-primary btn-sm"><?=$nilai_avg_target_q3?></button>&nbsp;
					<button class="btn btn-info btn-sm"><?=$nilai_avg_target_q4?></button>&nbsp;

				</td>
					<?php
					#hitung nilai capaian q1
					$array_capaian_q1 = array();
					$data_porsi_pic = IkuCapaianHeader::find()
					->select(['seksi_pic'])
					->where(['id_header'=> $id_iku])
					->all();
					foreach ($data_porsi_pic as $data_porsi_pic) {
						$seksi_pic = $data_porsi_pic->seksi_pic;
						$sum_capaian_q1 = Yii::$app->db
						    ->createCommand("SELECT capaian_q1*porsi_pic
						        FROM iku_capaian_header 
						        where id_header = $id_iku
						        and seksi_pic = $seksi_pic");
						$nilai_capaian_q1 = $sum_capaian_q1->queryScalar();
						array_push($array_capaian_q1, $nilai_capaian_q1);
					}
					$total_capaian_q1 = array_sum($array_capaian_q1);
					#hitung nilai capaian q2
					$array_capaian_q2 = array();
					$data_porsi_pic = IkuCapaianHeader::find()
					->select(['seksi_pic'])
					->where(['id_header'=> $id_iku])
					->all();
					foreach ($data_porsi_pic as $data_porsi_pic) {
						$seksi_pic = $data_porsi_pic->seksi_pic;
						$sum_capaian_q2 = Yii::$app->db
						    ->createCommand("SELECT capaian_q2*porsi_pic
						        FROM iku_capaian_header 
						        where id_header = $id_iku
						        and seksi_pic = $seksi_pic");
						$nilai_capaian_q2 = $sum_capaian_q2->queryScalar();
						array_push($array_capaian_q2, $nilai_capaian_q2);
					}
					$total_capaian_q2 = array_sum($array_capaian_q2);
					#hitung nilai capaian q3
					$array_capaian_q3 = array();
					$data_porsi_pic = IkuCapaianHeader::find()
					->select(['seksi_pic'])
					->where(['id_header'=> $id_iku])
					->all();
					foreach ($data_porsi_pic as $data_porsi_pic) {
						$seksi_pic = $data_porsi_pic->seksi_pic;
						$sum_capaian_q3 = Yii::$app->db
						    ->createCommand("SELECT capaian_q3*porsi_pic
						        FROM iku_capaian_header 
						        where id_header = $id_iku
						        and seksi_pic = $seksi_pic");
						$nilai_capaian_q3 = $sum_capaian_q3->queryScalar();
						array_push($array_capaian_q3, $nilai_capaian_q3);
					}
					$total_capaian_q3 = array_sum($array_capaian_q3);
					#hitung nilai capaian q4
					$array_capaian_q4 = array();
					$data_porsi_pic = IkuCapaianHeader::find()
					->select(['seksi_pic'])
					->where(['id_header'=> $id_iku])
					->all();
					foreach ($data_porsi_pic as $data_porsi_pic) {
						$seksi_pic = $data_porsi_pic->seksi_pic;
						$sum_capaian_q4 = Yii::$app->db
						    ->createCommand("SELECT capaian_q4*porsi_pic
						        FROM iku_capaian_header 
						        where id_header = $id_iku
						        and seksi_pic = $seksi_pic");
						$nilai_capaian_q4 = $sum_capaian_q4->queryScalar();
						array_push($array_capaian_q4, $nilai_capaian_q4);
					}
					$total_capaian_q4 = array_sum($array_capaian_q4);
					#COLORING Q1
					if (($nilai_avg_target_q1<>0) && ($total_capaian_q1/$nilai_avg_target_q1/100 < 0.5)) {
						$class_q1 = "text-center bg-danger";
						$button_q1 = "btn btn-danger";
					}
					elseif (($nilai_avg_target_q1<>0) && ($total_capaian_q1/$nilai_avg_target_q1/100 < 0.7)) {
						$class_q1 = "text-center bg-warning";
						$button_q1 = "btn btn-warning";
					}
					else{
						$class_q1 = "text-center bg-success";
						$button_q1 = "btn btn-success";
					}
					#COLORING q2
					if (($nilai_avg_target_q2<>0) && ($total_capaian_q2/$nilai_avg_target_q2/100 < 0.5)) {
						$class_q2 = "text-center bg-danger";
						$button_q2 = "btn btn-danger";
					}
					elseif (($nilai_avg_target_q2<>0) && ($total_capaian_q2/$nilai_avg_target_q2/100 < 0.7)) {
						$class_q2 = "text-center bg-warning";
						$button_q2 = "btn btn-warning";
					}
					else{
						$class_q2 = "text-center bg-success";
						$button_q2 = "btn btn-success";
					}
					#COLORING q3
					if (($nilai_avg_target_q3<>0) && ($total_capaian_q3/$nilai_avg_target_q3/100 < 0.5)) {
						$class_q3 = "text-center bg-danger";
						$button_q3 = "btn btn-danger";
					}
					elseif (($nilai_avg_target_q3<>0) && ($total_capaian_q3/$nilai_avg_target_q3/100 < 0.7)) {
						$class_q3 = "text-center bg-warning";
						$button_q3 = "btn btn-warning";
					}
					else{
						$class_q3 = "text-center bg-success";
						$button_q3 = "btn btn-success";
					}
					#COLORING q4
					if (($nilai_avg_target_q4<>0) && ($total_capaian_q4/$nilai_avg_target_q4/100 < 0.5)) {
						$class_q4 = "text-center bg-danger";
						$button_q4 = "btn btn-danger";
					}
					elseif (($nilai_avg_target_q4<>0) && ($total_capaian_q4/$nilai_avg_target_q4/100 < 0.7)) {
						$class_q4 = "text-center bg-warning";
						$button_q4 = "btn btn-warning";
					}
					else{
						$class_q4 = "text-center bg-success";
						$button_q4 = "btn btn-success";
					}
					?>
				<td class="<?=$class_q1?>">
					<button class="<?=$button_q1?>"><?=$total_capaian_q1/100;?></button>
				</td>
				<td class="<?=$class_q2?>">
					<button class="<?=$button_q2?>"><?=$total_capaian_q2/100;?>
				</td>
				<td class="text-center bg-info">
					<?=($total_capaian_q1/100)+($total_capaian_q2/100)?>
				</td>
				<td class="<?=$class_q3?>">
					<button class="<?=$button_q3?>"><?=$total_capaian_q3/100;?>
				</td>
				<td class="text-center bg-info">
					<?=($total_capaian_q1/100)+($total_capaian_q2/100)+($total_capaian_q3/100)?>
				</td>
				<td class="<?=$class_q4?>">
					<button class="<?=$button_q4?>"><?=$total_capaian_q4/100;?>
				</td>
				<td class="text-center bg-info">
					<?=($total_capaian_q1/100)+($total_capaian_q2/100)+($total_capaian_q3/100)+($total_capaian_q4/100)?>
				</td>

			</tr>
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
							// $link_target = 'iku-target/update1?id='.$data_target->id.'&tahun='.$tahun;
							$link_target = 'iku-target/update1?id='.$data_target->id;
						}
						else{
							$target_q1 = "0";
							$target_q2 = "0";
							$target_q3 = "0";
							$target_q4 = "0";
							$link_target = 'iku-target/create1';
						}

						$data_capaian = Ikucapaian::find()
						->select(['*'])
						->where(['id_pic'=>$id_pic])
						->one();
						if($data_capaian){
							$capaian_q1 = $data_capaian->capaian_q1;
							if (is_null($capaian_q1)) {
								$capaian_q1 = 'x';
							}
							else{
								$capaian_q1 = $data_capaian->capaian_q1;
							}
							$capaian_q2 = $data_capaian->capaian_q2;
							if (is_null($capaian_q2)) {
								$capaian_q2 = 'x';
							}
							else{
								$capaian_q1 = $data_capaian->capaian_q2;
							}
							$capaian_q3 = $data_capaian->capaian_q3;
							if (is_null($capaian_q3)) {
								$capaian_q3 = 'x';
							}
							else{
								$capaian_q3 = $data_capaian->capaian_q3;
							}
							$capaian_q4 = $data_capaian->capaian_q4;
							if (is_null($capaian_q4)) {
								$capaian_q4 = 'x';
							}
							else{
								$capaian_q4 = $data_capaian->capaian_q4;
							}
							// $link_capaian = 'iku-capaian/update1?id='.$data_capaian->id.'&tahun='.$tahun;
							$link_capaian = 'iku-capaian/update1?id='.$data_capaian->id;
						}
						else{
							$capaian_q1 = "0";
							$capaian_q2 = "0";
							$capaian_q3 = "0";
							$capaian_q4 = "0";
							$link_capaian = 'iku-capaian/create1';
						}

					$seksi_pic = $data_pic->seksi_pic;
						$data_seksi = KpknlStruktur::find()
						->select(['*'])
						->where(['id'=>$seksi_pic])
						->one();
						$ur_seksi_singk = $data_seksi->ur_seksi_singk;
					$porsi_pic = $data_pic->porsi_pic;
					
					#COLORING q1
					if (($target_q1<>0) && ($capaian_q1/$target_q1 < 0.5)) {
						$bg_q1 = "bg bg-danger";
					}
					elseif (($target_q1<>0) && ($capaian_q1/$target_q1 < 0.7)) {
						$bg_q1 = "bg bg-yellow";
					}
					else{
						$bg_q1 = "bg bg-success";
					}
					#COLORING q2
					if (($target_q2<>0) && ($capaian_q2/$target_q2 < 0.5)) {
						$bg_q2 = "bg bg-danger";
					}
					elseif (($target_q2<>0) && ($capaian_q2/$target_q2 < 0.7)) {
						$bg_q2 = "bg bg-yellow";
					}
					else{
						$bg_q2 = "bg bg-success";
					}
					#COLORING q3
					if (($target_q3<>0) && ($capaian_q3/$target_q3 < 0.5)) {
						$bg_q3 = "bg bg-danger";
					}
					elseif (($target_q3<>0) && ($capaian_q3/$target_q3 < 0.7)) {
						$bg_q3 = "bg bg-yellow";
					}
					else{
						$bg_q3 = "bg bg-success";
					}
					#COLORING q4
					if (($target_q4<>0) && ($capaian_q4/$target_q4 < 0.5)) {
						$bg_q4 = "bg bg-danger";
					}
					elseif (($target_q4<>0) && ($capaian_q4/$target_q4 < 0.7)) {
						$bg_q4 = "bg bg-yellow";
					}
					else{
						$bg_q4 = "bg bg-success";
					}

					?>
					<tr style="vertical-align: middle">
						<td style="vertical-align: middle">
						</td>
						<td style="vertical-align: middle">
							<?= Html::a(
			        				'-&nbsp;'.$ur_seksi_singk.' ('.number_format($porsi_pic,0,",",".").'%)', 
			        				[
			        					'/iku-pic/update2',
			        					'id' => $id_pic,
			        					'id_href' => $id_href,
			        					'tahun' =>$tahun
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
						</td>
						<td class="text-center" style="vertical-align: middle">
								<?= Html::a(
			        				'<button class="btn btn-link btn-sm">'.$target_q1."</button>&nbsp;". 
			        				'<button class="btn btn-link btn-sm">'.$target_q2."</button>&nbsp;". 
			        				'<button class="btn btn-link btn-sm">'.$target_q3."</button>&nbsp;".
			        				'<button class="btn btn-link btn-sm">'.$target_q4."</button>" , 
			        				[
			        					$link_target,
			        					'id_href' => $id_href,
			        					'id_pic' => $id_pic,
			        					'tahun' => $tahun,
			        					], 
			        				[
			        					'class' => 'btn btn-link btn-sm',
			        					'data' => [
			        						// 'confirm' => 'Tambah Proses?',
			        						'method' => 'post',
			        						],
			        					]
			        				);
			        			?>
		
						</td>

						<td class="text-center <?=$bg_q1?>" style="vertical-align: middle">
								<?= Html::a(
			        				'<button class="btn btn-link btn-sm">'.$capaian_q1."</button>", 
			        				[
			        					$link_capaian,
			        					'id_href' => $id_href,
			        					'id_pic' => $id_pic,
			        					'tahun' => $tahun,
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
		
						</td>
						<td class="text-center <?=$bg_q2?>" style="vertical-align: middle">
								<?= Html::a(
			        				'<button class="btn btn-link btn-sm">'.$capaian_q2."</button>", 
			        				[
			        					$link_capaian,
			        					'id_href' => $id_href,
			        					'id_pic' => $id_pic,
			        					'tahun' => $tahun,
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
		
						</td>
						<td class="text-center" style="vertical-align: middle"><?=$capaian_q1+$capaian_q2?></td>
						
						<td class="text-center <?=$bg_q3?>" style="vertical-align: middle">
								<?= Html::a(
			        				'<button class="btn btn-link btn-sm">'.$capaian_q3."</button>", 
			        				[
			        					$link_capaian,
			        					'id_href' => $id_href,
			        					'id_pic' => $id_pic,
			        					'tahun' => $tahun,
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
		
						</td>
						<td class="text-center" style="vertical-align: middle"><?=$capaian_q1+$capaian_q2+$capaian_q3?></td>
						
						<td class="text-center <?=$bg_q4?>" style="vertical-align: middle">
								<?= Html::a(
			        				'<button class="btn btn-link btn-sm">'.$capaian_q4."</button>", 
			        				[
			        					$link_capaian,
			        					'id_href' => $id_href,
			        					'id_pic' => $id_pic,
			        					'tahun' => $tahun,
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
		
						</td>
						<td class="text-center" style="vertical-align: middle"><?=$capaian_q1+$capaian_q2+$capaian_q3+$capaian_q4?></td>

						
					</tr>
					<?php
			}
		}
	}

	?>
	</tbody>
</table>
