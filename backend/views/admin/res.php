<?php
use yii\helpers\Html;
use backend\models\RequestDetail;
use backend\models\RequestDetailRespon;
use backend\models\RequestRespon;
use backend\models\RequestResponRef;
use backend\models\RequestHeader;
use backend\models\KpknlStakeholder;
use backend\models\KpknlLayananProses;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Hasil Pencarian Dokumen';

if (isset($_POST['ticket_code'])) {
    $ticket_code = $_POST['ticket_code'];
}
elseif (isset($_GET['ticket_code'])) {
    $ticket_code = $_GET['ticket_code'];
}
else{

    $ticket_code = 'XXXXXX';
}

$data_tiket = RequestHeader::find()
    ->select(['*'])
    ->where(['ticket_code'=>$ticket_code])
    ->one();
if ($data_tiket) {
    # code...

    $id_req_header = $data_tiket->id;
    $no_dokumen = $data_tiket->no_dokumen;
    $id_stakeholder = $data_tiket->id_stakeholder;
        $data_stakeholder = KpknlStakeholder::find()
            ->select(['*'])
            ->where(['id'=>$id_stakeholder])
            ->one();
            $nama_stakeholder = $data_stakeholder->nama;
    $tgl_dok = $data_tiket->tgl_dok;
    $id_layanan = $data_tiket->id_layanan;
    $tgl_terima = $data_tiket->tgl_terima;
    $keterangan = $data_tiket->keterangan;
    #sudah tuntas
    $status_dok = $data_tiket->status;
    if ($status_dok==0) {
        $progres = "Masih dalam proses.";
        $kirim_komen = "";
        $ket_komen = "<br><code>Mohon berikan penilaian dan komentar Anda</code>";
    }
    if ($status_dok==1) {
        $progres = "Selesai";
        $kirim_komen = " disabled";
        $ket_komen ="<br><code>Komentar telah ditutup.</code>";
    }

?>
<div class="site-index">
    <div class="body-content">

    <div class="row">
        <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading text-center">
            <h2><b>DOKUMEN ANDA</b></h2>
            </div>
            <div class="panel-body">
            <?php
                echo "Dokumen ".$no_dokumen.", tanggal ".date_format(date_create($tgl_dok),"d-m-Y");
                echo "<br>";
                echo "Diterima dari: ".$nama_stakeholder;
                echo ", tgl: ".date_format(date_create($tgl_terima),"d-m-Y");
                echo "<br>";
                echo "Keterangan: ".$keterangan;
            ?>
            </div>
        </div>
        </div>

        <div class="col-md-2">
        <div class="panel panel-danger">
            <div class="panel-heading text-center">
            <h2><b>TIKET</b></h2>
            </div>
            <div class="panel-body text-center">
            <font size="50"><kbd>&nbsp;<?= $ticket_code ?>&nbsp;</kbd></font>
            </div>
        </div>
        </div>
    </div>

        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center bg-primary">No</th>
                    <th class="text-center bg-primary">Progres</th>
                    <th class="text-center bg-primary">Tanggal</th>
                    <th class="text-center bg-primary">Keterangan</th>
                </tr>
            </thead>

            <tbody>
            <?php
            #daftar proses
            $no_proses = 1;
            $daftar_proses = RequestDetail::find()
                ->select(['*'])
                ->where(['id_req_header'=>$id_req_header])
                ->distinct()
                ->orderBy(['tgl_proses'=>SORT_ASC])->all();
            foreach ($daftar_proses as $daftar_proses) {
                $id_proses = $daftar_proses->id_proses;
                    $data_proses = KpknlLayananProses::find()
                        ->select(['*'])
                        ->where(['id'=>$id_proses])
                        ->one();
                        $ur_proses = $data_proses->ur_proses;
                $tgl_proses = $daftar_proses->tgl_proses;
                $keterangan = $daftar_proses->keterangan;
                ?>
                <tr>
                    <td class="text-center"><?=$no_proses?>.</td>
                    <td><?=$ur_proses?></td>
                    <td><?=date_format(date_create($tgl_proses),"d-m-Y")?></td>
                    <td><?=$keterangan?></td>
                </tr>
                <?php
                $no_proses++;
                }
                ?>
            </tbody>
        </table>

    <hr>
    <div class="row">
    <div class="col-md-2">
    <div class="panel panel-warning">
        <div class="panel-heading">
        <h4><b>STATUS DOKUMEN</b></h4>
        <!-- <hr> -->
        </div>
        <div class="panel-body">
        <?=$progres?><?=$ket_komen?>
        </div>          
    </div>
    </div>
    </div>

  


      


    <div class="container-fluid">
    <h2>Apakah Anda puas dengan pelayanan kami?</h2>
    <div class="row">
    <div class="col-md-6">
    <table>
        <tbody>
        <tr>
        <?php
        $daftar_respon_ref = RequestResponRef::find()
                ->select(['*'])
                ->orderBy(['id'=>SORT_ASC])->all();
            foreach ($daftar_respon_ref as $daftar_respon_ref) {
                $id_respon_ref = $daftar_respon_ref->id;
                $ur_respon_ref = $daftar_respon_ref->ur_respon;
                $href = "../img/icons/".$id_respon_ref.".png";
                #cari di tabel respon
                $cari_respon = RequestRespon::find()
                    ->select(['*'])
                    ->where(['ticket_code'=>$ticket_code])
                    ->one();
                if($cari_respon){
                    $id_req_respon = $cari_respon->id;
                    $id_respon = $cari_respon->id_respon;
                    $comment = $cari_respon->comment;
                    // echo "sudah ada";
                    if($id_respon == $id_respon_ref){
                        $panel = "panel panel-danger";
                        $size = "width:150%";
                        $action = '../request-respon/update?id='.$id_req_respon;
                        $respon = $ur_respon_ref;
                    }
                    else{
                        $panel = "";
                        $size = "width:100%";
                        $action = '../request-respon/update?id='.$id_req_respon;
                        $respon = "";
                    }
                }
                else{
                    // echo "belum ada";
                    $panel = "";
                    $size = "width:100%";
                    $comment = '';
                    $action = '../request-respon/create';
                    $respon = "";
                    #id
                    $max_id = RequestRespon::find()
                        ->select('id')
                        ->orderBy(['id'=>SORT_DESC])
                        ->one();

                    if ($max_id) {
                        $id_req_respon = $max_id->id + 1;
                    }
                    else{
                        $id_req_respon = 1;
                    }
                }

                
                ?>
                <td class="">
                    <div class="<?=$panel?>">
                        <div class="panel-heading">
                        <h4><b><?=$respon?></b></h4>
                        <hr>
                    <?php
                    $model = new RequestRespon();
                    ?>

                        <?php $form = ActiveForm::begin(['action'=>$action]); ?>
                        <?= $form->field($model, 'id')->textInput(['value' => $id_req_respon, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>

                        <?= $form->field($model, 'ticket_code')->textInput(['value' => $ticket_code, 'type' => 'hidden'])->label(false) ?>

                        <?= $form->field($model, 'id_respon')->textInput(['value' => $id_respon_ref, 'type' => 'hidden'])->label(false) ?>

                        <?= $form->field($model, 'tgl_respon')->textInput(['value' => date('Y-m-d'), 'type' => 'hidden'])->label(false) ?>
                        <?= $form->field($model, 'comment')->hiddenInput(['value'=>$comment, 'rows' => 6, 'type' => 'hidden'])->label(false) ?>

                            <?= Html::submitButton('<img style="'.$size.'" src='.$href.'>', ['class' => 'btn btn-link '.$kirim_komen]) ?>


                        <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </td>
                <?php
            }
            ?>
        </tr>
        </tbody>
    </table>
    <hr>
    <hr>
    <hr>
    <?php
    #cari di tabel respon
    $cari_respon = RequestRespon::find()
        ->select(['*'])
        ->where(['ticket_code'=>$ticket_code])
        ->one();
    if($cari_respon){
        $id_req_respon = $cari_respon->id;
        $id_respon = $cari_respon->id_respon;
        $comment = $cari_respon->comment;
        if($comment == ""){
            ?>
                <p>Anda belum memberikan komentar/usul/saran.<br>
                <a class="btn btn-default" href="../request-respon/update?id=<?=$id_req_respon?>">
                <span class="glyphicon glyphicon-pencil"> Komentar
                </span>
                </a>
                </p>
            <?php
        }
        elseif($comment <> ""){
            ?>
                <p><i>Terimakasih, komentar Anda telah kami terima.</i><br>
                [<?=$comment?>]
                <a class="btn btn-default <?=$kirim_komen?>" href="../request-respon/update?id=<?=$id_req_respon?>">
                <span class="glyphicon glyphicon-pencil"> Edit
                </span>
                </a>
                </p>
            <?php
        }
    }
    else{
        echo "";
    }
    ?>
    
    </div>
    </div>
    </div>

<!-- <img src="../img/icons/1.png" alt="Profil1" style="width:100%;"> -->
<!-- <img src="../img/icons/1.png" style="width:5%;"> -->
        
    </div>
</div>
<?php
}
else{

    echo "Dokumen dengan nomor tiket ".$ticket_code." tidak ada";

}
?>
