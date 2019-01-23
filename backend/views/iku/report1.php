<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use backend\models\IkuSs;
use backend\models\IkuHeader;
use backend\models\IkuPic;
use backend\models\IkuTarget;
use backend\models\IkuCapaian;
use backend\models\IkuCapaianHeader;
use backend\models\KpknlStruktur;
// $tahun = date('Y');
$tahun = $_POST['tahun'];
$periode = $_POST['periode'];
$this->title = 'LAPORAN INDIKATOR KINERJA UTAMA TAHUN '.$tahun;
$this->params['breadcrumbs'][] = $this->title;
?>

<h5 class="text-center" style="font-family: serif;"><b>RINCIAN TARGET DAN CAPAIAN KINERJA</b></h5>
<h5 class="text-center" style="font-family: serif;"><b>KEPALA KANTOR PELAYANAN KEKAYAAN NEGARA DAN LELANG BEKASI</b></h5>
<h5 class="text-center" style="font-family: serif;"><b>DIREKTORAT JENDERAL KEKAYAAN NEGARA - <?=$periode?> TAHUN 2018</b></h5>
<!-- <br> -->


<!-- <table class="table table-striped table-hover table-bordered widecells" cellPadding=2> -->
<table style="border-collapse: collapse; page-break-inside:auto; overflow: wrap" border=1 cellspacing=0.01 cellpadding=2>
    <thead>
    	<tr class="text-center">
    		<th rows="2">No</th>
    		<th class="text-center" colspan="2">SS, IKU</th>
    		<th class="text-center">Target<br><?=$periode?></th>
    		<th class="text-center">Realisasi <?=$periode?></th>
    	</tr>
        <!-- <tr>
    		<th>No</th>
    		<th>SS, IKU</th>
    		<th>no</th>
    		<th>Target</th>
    		<th>Q1</th>
    		<th>Q2</th>
    		<th>SMST I</th>
    		<th>Q3</th>
    		<th>sd. Q3</th>
    		<th>Q4</th>
    		<th>Tahunan</th>
    	</tr> -->
    </thead>

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
			<td class="text-center"><b><?=$no_urut?>.</b></td>
			<td colspan="4" ><b><?=$ur_ss?></b></td>
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
			#hitung rata-rata target
			$avg_target = Yii::$app->db
			    ->createCommand("SELECT avg(target_$periode) 
			        FROM iku_target_header 
			        where id_header = $id_iku");
			$nilai_avg_target = $avg_target->queryScalar();
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

			#hitung nilai capaian
			$array_capaian = array();
			$data_porsi_pic = IkuCapaianHeader::find()
			->select(['seksi_pic'])
			->where(['id_header'=> $id_iku])
			->all();
			foreach ($data_porsi_pic as $data_porsi_pic) {
				$seksi_pic = $data_porsi_pic->seksi_pic;
				$sum_capaian = Yii::$app->db
				    ->createCommand("SELECT capaian_$periode*porsi_pic
				        FROM iku_capaian_header 
				        where id_header = $id_iku
				        and seksi_pic = $seksi_pic");
				$nilai_capaian = $sum_capaian->queryScalar();
				array_push($array_capaian, $nilai_capaian);
			}
			$total_capaian = array_sum($array_capaian);

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
			?>
			<tr>
				<td></td>
				<td colspan="2">
					[<?=$kd_iku?>]
					<?=$ur_iku?>
				</td>
				<td class="text-center"><?=$nilai_avg_target?></td>
				<td class="text-center"><?=$total_capaian/100?></td>
			</tr>
					<?php
		}
	}

	?>
	</tbody>
</table>
<!-- <br> -->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Bekasi,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2018<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Kepala Kantor Pelayanan  <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Kekayaan Negara dan Lelang Bekasi,<br>
<!-- <br> -->
<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Partolo<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
NIP 196803231988031004