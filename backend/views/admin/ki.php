<?php
/* @var $this yii\web\View */
use backend\models\KpknlLayanan;
use backend\models\KpknlLayananProses;
use backend\models\RequestHeader;
use backend\models\RequestDetail;
use backend\models\KpknlStakeholder;
use backend\models\KpknlStruktur;
use yii\helpers\Html;
use yii\helpers\Url;
$id_seksi = 6;
$data_seksi = KpknlStruktur::find()
    ->select(['*'])
    ->where(['id'=>$id_seksi])
    ->one();
    $ur_seksi_singk = $data_seksi->ur_seksi_singk;
    $ur_seksi = $data_seksi->ur_seksi;
$this->title = $ur_seksi;
?>
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
		        ->orderBy(['tgl_dok'=>SORT_ASC])->all();
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
			        // $nama = $id_stakeholder;
		    	$tgl_terima = $daftar_request->tgl_terima;
		    	$ticket_code = $daftar_request->ticket_code;
		    	$keterangan = $daftar_request->keterangan;

    		?>
    		<tr>
        		<td class="text-center bg-info" class=""><?=$no_request?>.
        			<br>
        			<a id=<?=$id_req_header?>></a>
        			<?php
        			echo Html::beginForm('../request-detail/create','post',['class' => 'form-inline']);
				        echo Html::textInput('id_req_header',$id_req_header,['class'=>'form-control required','type'=>'hidden']);
				        // echo Html::textInput('ur_seksi_singk',$ur_seksi_singk,['class'=>'form-control required','type'=>'hidden']);
				        echo Html::submitButton('<span class="glyphicon glyphicon-plus"></span>',[
				        	'class'=>'btn btn-link',
				        	'label' => [
				        		'title' => 'Tambah Proses',
				        		]
				        	]);
				    echo Html::endForm();
        			?>
        		</td>
        		<td class="bg-info" colspan="2">
        		<?php
        			echo "Dokumen ".$no_dokumen.", tanggal ".date_format(date_create($tgl_dok),"d-m-Y");
        			echo "<br>";
        			echo "Diterima dari: ".$nama;
        			echo ", tgl: ".date_format(date_create($tgl_terima),"d-m-Y");
        			echo "<br>";
        			echo "Nomor Tiket: ".$ticket_code;
        			echo "<br>";
        			echo "Keterangan: ".$keterangan;
        		?>
        			
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
	        				<?php
		        			echo Html::beginForm('../request-detail/sms','post',['class' => 'form-inline']);
						        echo Html::textInput('id_req_detail',$id_req_detail,['class'=>'form-control required','type'=>'hidden']);
						        echo Html::submitButton('<span class="glyphicon glyphicon-send"></span>',[
						        	'class'=>'btn btn-link',
						        	'data' => [
        								'confirm' => 'Mau Kirim SMS ke '.$nama.'?',
        								// 'method' => 'get',
        							],
        							]);
						    echo Html::endForm();
						    ?>
	        			</td>
			        	<td>
			        		<?=$ur_proses?>, 
			        		<?= date_format(date_create($tgl_proses),"d-m-Y")?>
			        		<br>
			        		<?= $keterangan?>
			        		<br>
			        		<table>
			        			<tr>
			        				<td>
			        					<?php
					        			echo Html::beginForm('../request-detail/update','get',['class' => 'form-inline']);
									        echo Html::textInput('id',$id_req_detail,['class'=>'form-control required','type'=>'hidden']);
									        echo Html::submitButton('<span class="glyphicon glyphicon-pencil"></span>',['class'=>'btn btn-link']);
									    echo Html::endForm();
					        			?>
			        				</td>
			        				<td>
			        					<?php
									    echo Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::toRoute(['/request-detail/delete', 'id' => $id_req_detail]), ['data-method' => 'post', 'class' => 'btn btn-link'])
					        			?>
			        				</td>
			        			</tr>
			        		</table>
			        	</td>
			        	<td class="text-center">
			        		
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

