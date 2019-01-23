<?php
/* @var $this yii\web\View */
use backend\models\KpknlLayanan;
use backend\models\KpknlLayananProses;
use backend\models\RequestHeader;
use backend\models\RequestDetail;
use backend\models\KpknlStakeholder;
use backend\models\KpknlStruktur;
use backend\models\HistoryMessage;
use backend\models\TiketSeksi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$id_seksi = 3;
$data_seksi = KpknlStruktur::find()
    ->select(['*'])
    ->where(['id'=>$id_seksi])
    ->one();
    $ur_seksi_singk = $data_seksi->ur_seksi_singk;
    $ur_seksi = $data_seksi->ur_seksi;

// function indonesian_date ($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB') {
function indonesian_date ($timestamp = '', $date_format = 'l, j F Y', $suffix = '') {
	if (trim ($timestamp) == '')
	{
	$timestamp = time ();
	}
	elseif (!ctype_digit ($timestamp))
	{
	$timestamp = strtotime ($timestamp);
	}
	# remove S (st,nd,rd,th) there are no such things in indonesia :p
	$date_format = preg_replace ("/S/", "", $date_format);
	$pattern = array (
	'/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
	'/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
	'/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
	'/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
	'/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
	'/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
	'/April/','/June/','/July/','/August/','/September/','/October/',
	'/November/','/December/',
	);
	$replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
	'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
	'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
	'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
	'Oktober','November','Desember',
	);
	$date = date ($date_format, $timestamp);
	$date = preg_replace ($pattern, $replace, $date);
	$date = "{$date} {$suffix}";
	return $date;
}

$hari_ini = indonesian_date(time(),'l, j F Y');
$bulan_ini = indonesian_date(time(),'F');
$tahun_ini = date('Y');

#hitung jumlah dokumen masuk hari ini
$masuk_hari_ini = TiketSeksi::find()
->where(['tgl_terima' => date('Y-m-d')])
->andWhere(['id_seksi'=>$id_seksi])
->count();
#hitung jumlah dokumen masuk bulan ini
$masuk_bulan_ini = TiketSeksi::find()
->where([('month(tgl_terima)') => date('m')])
->andWhere(['id_seksi'=>$id_seksi])
->count();
#hitung jumlah dokumen masuk tahun ini
$masuk_tahun_ini = TiketSeksi::find()
->where([('year(tgl_terima)') => date('Y')])
->andWhere(['id_seksi'=>$id_seksi])
->count();

#hitung jumlah dokumen dalam proses hari ini
$proses_hari_ini = TiketSeksi::find()
->where(['tgl_terima' => date('Y-m-d')])
->andWhere(['id_seksi'=>$id_seksi])
->andWhere(['status'=>0])
->count();
#hitung jumlah dokumen proses bulan ini
$proses_bulan_ini = TiketSeksi::find()
->where([('month(tgl_terima)') => date('m')])
->andWhere(['id_seksi'=>$id_seksi])
->andWhere(['status'=>0])
->count();
#hitung jumlah dokumen proses tahun ini
$proses_tahun_ini = TiketSeksi::find()
->where([('year(tgl_terima)') => date('Y')])
->andWhere(['id_seksi'=>$id_seksi])
->andWhere(['status'=>0])
->count();

#hitung jumlah dokumen dalam selesai hari ini
$selesai_hari_ini = TiketSeksi::find()
->where(['tgl_terima' => date('Y-m-d')])
->andWhere(['id_seksi'=>$id_seksi])
->andWhere(['status'=>1])
->count();
#hitung jumlah dokumen selesai bulan ini
$selesai_bulan_ini = TiketSeksi::find()
->where([('month(tgl_terima)') => date('m')])
->andWhere(['id_seksi'=>$id_seksi])
->andWhere(['status'=>1])
->count();
#hitung jumlah dokumen selesai tahun ini
$selesai_tahun_ini = TiketSeksi::find()
->where([('year(tgl_terima)') => date('Y')])
->andWhere(['id_seksi'=>$id_seksi])
->andWhere(['status'=>1])
->count();



$tgl_now = date('Y-m-d');
$bulan_now = date('m');
$tahun_now = date('Y');
// echo $tgl_now;
// echo "<br>";
// echo $bulan_now;
// echo "<br>";
// echo $tahun_now;
// echo "<br>";

$this->title = $ur_seksi;
?>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#daily">Daily</a></li>
  <li><a data-toggle="tab" href="#monthly">Monthly</a></li>
  <li><a data-toggle="tab" href="#annually">Annually</a></li>
</ul>

<div class="tab-content">
  <div id="daily" class="tab-pane fade in active">
    <h3>Penerimaan dokumen pada hari ini: <?=$hari_ini?></h3>

    <div class="row">
		<div class="col-md-2">
		    <div class="panel panel-info">
		        <div class="panel-heading">
		        <h4 class="text-center"><b><i class="fa fa-hourglass-start"></i> Dokumen Masuk</b></h4>
		        </div>
		    <div class="panel-body text-center">
		    <font size='50' color="blue"><b><?=$masuk_hari_ini?></b></font>
		    </div>          
		    </div>
		</div>
		<div class="col-md-2">
		    <div class="panel panel-danger">
		        <div class="panel-heading">
		        <h4 class="text-center"><b><i class="fa fa-hourglass-half"></i> Dalam Proses</b></h4>
		        </div>
		    <div class="panel-body text-center">
		    <font size='50' color="red"><b><?=$proses_hari_ini?></b></font>
		    </div>          
		    </div>
		</div>
		<div class="col-md-2">
		    <div class="panel panel-success">
		        <div class="panel-heading">
		        <h4 class="text-center"><b><i class="fa fa-hourglass-end"></i> Selesai</b></h4>
		        </div>
		    <div class="panel-body text-center">
		    <font size='50' color="green"><b><?=$selesai_hari_ini?> <i class="fa fa-check"></i></b></font>
		    </div>          
		    </div>
		</div>
	</div>

  </div>
  <div id="monthly" class="tab-pane fade">
    <h3>Penerimaan dokumen selama bulan <?=$bulan_ini?> <?=$tahun_ini?></h3>
    <div class="row">
		<div class="col-md-2">
		    <div class="panel panel-info">
		        <div class="panel-heading">
		        <h4 class="text-center"><b><i class="fa fa-hourglass-start"></i> Dokumen Masuk</b></h4>
		        </div>
		    <div class="panel-body text-center">
		    <font size='50' color="blue"><b><?=$masuk_bulan_ini?></b></font>
		    </div>          
		    </div>
		</div>
		<div class="col-md-2">
		    <div class="panel panel-danger">
		        <div class="panel-heading">
		        <h4 class="text-center"><b><i class="fa fa-hourglass-half"></i> Dalam Proses</b></h4>
		        </div>
		    <div class="panel-body text-center">
		    <font size='50' color="red"><b><?=$proses_bulan_ini?></b></font>
		    </div>          
		    </div>
		</div>
		<div class="col-md-2">
		    <div class="panel panel-success">
		        <div class="panel-heading">
		        <h4 class="text-center"><b><i class="fa fa-hourglass-end"></i> Selesai</b></h4>
		        </div>
		    <div class="panel-body text-center">
		    <font size='50' color="green"><b><?=$selesai_bulan_ini?> <i class="fa fa-check"></i></b></font>
		    </div>          
		    </div>
		</div>
	</div>
  </div>
  <div id="annually" class="tab-pane fade">
    <h3>Penerimaan dokumen selama tahun  <?=$tahun_ini?></h3>
    <div class="row">
		<div class="col-md-2">
		    <div class="panel panel-info">
		        <div class="panel-heading">
		        <h4 class="text-center"><b><i class="fa fa-hourglass-start"></i> Dokumen Masuk</b></h4>
		        </div>
		    <div class="panel-body text-center">
		    <font size='50' color="blue"><b><?=$masuk_tahun_ini?></b></font>
		    </div>          
		    </div>
		</div>
		<div class="col-md-2">
		    <div class="panel panel-danger">
		        <div class="panel-heading">
		        <h4 class="text-center"><b><i class="fa fa-hourglass-half"></i> Dalam Proses</b></h4>
		        </div>
		    <div class="panel-body text-center">
		    <font size='50' color="red"><b><?=$proses_tahun_ini?></b></font>
		    </div>          
		    </div>
		</div>
		<div class="col-md-2">
		    <div class="panel panel-success">
		        <div class="panel-heading">
		        <h4 class="text-center"><b><i class="fa fa-hourglass-end"></i> Selesai</b></h4>
		        </div>
		    <div class="panel-body text-center">
		    <font size='50' color="green"><b><?=$selesai_tahun_ini?> <i class="fa fa-check"></i></b></font>
		    </div>          
		    </div>
		</div>
	</div>
  </div>
</div>


<div class="panel panel-default">
  <div class="panel-heading">
  	<h1 class="text-center">DAFTAR LAYANAN</h1>
  </div>
  <div class="panel-body">
  <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center bg-primary">No</th>
                <th class="text-center bg-primary">Nama Layanan, Uraian Dokumen, dan Proses</th>
                <th class="text-center bg-primary">Status</th>
            </tr>
        </thead>

    	<tbody>
        <?php
        #daftar penyerah piutang
	    $no_layanan = 1;
	    $daftar_layanan = KpknlLayanan::find()
	        ->select(['*'])
	        ->where(['id_seksi'=>$id_seksi])
	        ->distinct()
	        ->orderBy(['id'=>SORT_ASC])->all();
	    foreach ($daftar_layanan as $daftar_layanan) {
	    		$id_layanan = $daftar_layanan->id;
	    		$ur_layanan = $daftar_layanan->ur_layanan;
        	?>
        	<tr>
        		<td colspan="3" class="bg-success"><b><?=strtoupper($ur_layanan)?></b></td>
    		</tr>
    		<?php
    		$no_request = 1;
    		$daftar_request = RequestHeader::find()
		        ->select(['*'])
		        ->where(['id_layanan'=>$id_layanan])
		        // ->distinct()
		        ->orderBy(['status'=>SORT_ASC,'tgl_dok'=>SORT_ASC])->all();
		    foreach ($daftar_request as $daftar_request) {
		    	$id_req_header = $daftar_request->id;
		    	$no_dokumen = $daftar_request->no_dokumen;
		    	$tgl_dok = $daftar_request->tgl_dok;
		    	$id_stakeholder = $daftar_request->id_stakeholder;
			    	$data_stakeholder = KpknlStakeholder::find()
				        ->select(['*'])
				        ->where(['id'=>$id_stakeholder])
				        ->one();
			        	$nama = $data_stakeholder->nama;
			        	$telp = $data_stakeholder->telp;
			        // $nama = $id_stakeholder;
		    	$tgl_terima = $daftar_request->tgl_terima;
		    	$ticket_code = $daftar_request->ticket_code;
		    	$keterangan = $daftar_request->keterangan;
		    	$status = $daftar_request->status;
		    	$created_by = $daftar_request->created_by;
		    	$created_at = $daftar_request->created_at;
		    	$updated_by = $daftar_request->updated_by;
		    	$updated_at = $daftar_request->updated_at;
		    	if ($status==0) {
		    		$label = "<div class='progress-bar progress-bar-danger progress-bar-striped active' role='progressbar' aria-valuenow='100' style='width:100%'> &nbsp;&nbsp;ON PROCESS&nbsp;&nbsp; </div>";
		    		$btn = "btn btn-link";
		    		$status = 1;
		    		$akses = "";
		    		$title = "Klik untuk menyelesaikan proses";
		    	}
		    	else{
		    		$label = "<div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='100' style='width:100%'> &nbsp;&nbsp;<i class='fa fa-hourglass-end'></i>&nbsp;FINISHED&nbsp;&nbsp; </div>";
		    		// $label = "<i class='fa fa-hourglass-end'></i> FINISHED";
		    		$btn = "btn btn-link";
		    		$status = 0;
		    		$akses = "disabled";
		    		$title = "Klik untuk mengaktifkan proses";
		    	}
		    	$action = '../request-header/update1?id='.$id_req_header;

    		?>
    		<tr>
        		<td class="text-center bg-info" class=""><?=$no_request?>.
        			<br>
        			<a id=<?=$id_req_header?>></a>
        		</td>
        		<td class="bg-info" colspan="1">
        		<?php
        			echo "Dokumen ".$no_dokumen.", tanggal ".date_format(date_create($tgl_dok),"d-m-Y");
        			echo "<br>";
        			echo "Diterima dari: ".$nama;
        			echo ", tgl: ".date_format(date_create($tgl_terima),"d-m-Y");
        			echo "<br>";
        			echo "Nomor Tiket: ".$ticket_code;
        			echo "<br>";
        			echo "Keterangan: ".$keterangan;
        			echo Html::beginForm('../request-detail/create','post',['class' => 'form-inline']);
					        echo Html::textInput('id_req_header',$id_req_header,['class'=>'form-control required','type'=>'hidden']);
					        // echo Html::textInput('ur_seksi_singk',$ur_seksi_singk,['class'=>'form-control required','type'=>'hidden']);
					        // echo Html::submitButton('<span class="glyphicon glyphicon-plus"></span> Tambah Proses',[
					        echo Html::submitButton('Input Proses',[
					        	'class'=>'btn btn-primary '.$akses,
					        	'title' => 'Klik untuk menambah proses pada dokumen ini',
					        	'label' => [
					        		]
					        	]);
					    echo Html::endForm();
        		?>
        		</td>
        		<td class="bg-info text-center">
        			<?php

                    $model = new RequestHeader();
                    ?>

                        <?php $form = ActiveForm::begin(['action'=>$action]); ?>

					    <?= $form->field($model, 'id')->textInput(['value' => $id_req_header, 'readonly' => true, 'type'=>'hidden'])->label(false) ?>
					    <?= $form->field($model, 'id_stakeholder')->textInput(['value' => $id_stakeholder, 'readonly' => true, 'type'=>'hidden'])->label(false) ?>
					    <?= $form->field($model, 'no_dokumen')->textInput(['value' => $no_dokumen, 'readonly' => true, 'type'=>'hidden'])->label(false) ?>
					    <?= $form->field($model, 'tgl_dok')->textInput(['value' => $tgl_dok, 'readonly' => true, 'type'=>'hidden'])->label(false) ?>
					    <?= $form->field($model, 'id_layanan')->textInput(['value' => $id_layanan, 'readonly' => true, 'type'=>'hidden'])->label(false) ?>
					    <?= $form->field($model, 'tgl_terima')->textInput(['value' => $tgl_terima, 'readonly' => true, 'type'=>'hidden'])->label(false) ?>
					    <?= $form->field($model, 'ticket_code')->textInput(['value' => $ticket_code, 'readonly' => true, 'type'=>'hidden'])->label(false) ?>
					    <?= $form->field($model, 'status')->textInput(['value' => $status, 'readonly' => true, 'type'=>'hidden'])->label(false) ?>
					    <?= $form->field($model, 'keterangan')->textInput(['value' => $keterangan, 'readonly' => true, 'type'=>'hidden'])->label(false) ?>


					    <?= $form->field($model, 'created_by')->textInput(['value' => $created_by, 'readonly' => true, 'type'=>'hidden'])->label(false) ?>
					    <?= $form->field($model, 'created_at')->textInput(['value' => $created_at   , 'readonly' => true, 'type'=>'hidden'])->label(false) ?>
					    <?= $form->field($model, 'updated_by')->textInput(['value' => Yii::$app->user->identity->id, 'readonly' => true, 'type'=>'hidden'])->label(false) ?>
					    <?= $form->field($model, 'updated_at')->textInput(['value' => date('Y-m-d'), 'readonly' => true, 'type'=>'hidden'])->label(false) ?>

					    <div class="form-group">
					        <?= Html::submitButton($label, ['class' => $btn,'title'=>$title]) ?>
					    </div>

					    <?php ActiveForm::end(); ?>
        		</td>

        	</tr>
        	<?php
    		$no_detail	 = 1;
    		$daftar_request_detail = RequestDetail::find()
		        ->select(['*'])
		        ->where(['id_req_header'=>$id_req_header])
		        // ->distinct()
		        ->orderBy(['tgl_proses'=>SORT_ASC])->all();
		    		foreach ($daftar_request_detail	 as $daftar_request_detail) {
		    			$id_req_detail = $daftar_request_detail->id;
		    			$id_proses = $daftar_request_detail->id_proses;
		    					$data_proses = KpknlLayananProses::find()
							        ->select(['*'])
							        ->where(['id'=>$id_proses])
							        ->one();
						        	$ur_proses = $data_proses->ur_proses;
		    			$tgl_proses = $daftar_request_detail->tgl_proses;
		    			$keterangan = $daftar_request_detail->keterangan;
		    		?>
	        		<tr>
	        			<td class="text-center">
	        				
	        			</td>
			        	<td>
			        		<?=$ur_proses?>, 
			        		<?= date_format(date_create($tgl_proses),"d-m-Y")?>
			        		<br>
			        		<?= $keterangan?>
			        		
			        	</td>
			        	<td class="text-center">
			        		<table>
			        			<tr>
			        				<td>
			        					<?php
					        			echo Html::beginForm('../request-detail/update','get',['class' => 'form-inline']);
									        echo Html::textInput('id',$id_req_detail,['class'=>'form-control required','type'=>'hidden']);
									        echo Html::submitButton('<span class="glyphicon glyphicon-pencil"></span>',['class'=>'btn btn-link '.$akses, 'title'=>'Klik untuk merubah detail proses']);
									    echo Html::endForm();
					        			?>
			        				</td>
			        				<td>
			        					<?php
			        					#cek sms
								            $cari_histori_sms = HistoryMessage::find()
								            ->select(['*'])
								            ->where(['id_header'=>$id_req_header])
								            ->andWhere(['id_detail'=>$id_req_detail])
								            ->andWhere(['jenis'=>'sms'])
								            ->count();
			        					$content = 
            								"Yth. ".$nama.", status tiket ".$ticket_code.": ".$ur_proses.". Terimakasih. KPKNL Bekasi.";
					        			echo Html::beginForm('../request-detail/sms','post',['class' => 'form-inline']);
									        echo Html::textInput('id_req_detail',$id_req_detail,['class'=>'form-control required','type'=>'hidden']);
									        echo Html::submitButton('SMS <span class="label label-warning">'.$cari_histori_sms.'</span>',[
									        	'class'=>'btn btn-default '.$akses,
									        	'title'=>'Klik untuk kirim SMS ke stakeholder',
									        	'data' => [
			        								'confirm' => 'Mau Kirim SMS ke '.$nama.' no hp: '.$telp.'?. Isi Pesan: '.$content,
			        								// 'method' => 'get',
			        							],
			        							]);
									    echo Html::endForm();
									    ?>
			        				</td>
			        				<td>
			        					<?php
									    echo Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::toRoute(['/request-detail/delete', 'id' => $id_req_detail]), ['data-method' => 'post', 'class' => 'btn btn-link '.$akses, 'title'=>'Hapus Data'])
					        			?>
			        				</td>
			        			</tr>
			        		</table>
			        	</td>
			        </tr>
				    <?php
				    $no_detail++;
	        	}
	        	$no_request++;
	        }
	        $no_layanan++;
	    }
	    ?>
  		</tbody>
  </table>
  </div>
</div>

