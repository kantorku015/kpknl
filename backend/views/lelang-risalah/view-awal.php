<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\LelangObyek;
use backend\models\LelangPl;
use backend\models\LelangPemenang;
use backend\models\LelangRisalah;
use backend\models\LelangSetorHbl;
/* @var $this yii\web\View */
/* @var $model backend\models\LelangRisalah */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar RL', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-risalah-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'rl_no',
            'rl_tgl',
            'id_pl',
            'sppl_no',
            'sppl_tgl',
        ],
    ]) ?>
        <hr>
        <?= Html::a('Ambil Objek Lelang', ['lelang-obyek/index-select', 'rl_no' => $model->rl_no], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Rincian Penerimaan', ['lelang-risalah/rpn-pdf', 'rl_no' => $model->rl_no, 'size' => 11], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('SPPL', ['lelang-risalah/sppl-pdf', 'rl_no' => $model->rl_no], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Tanda Terima', ['lelang-risalah/tt-pdf', 'rl_no' => $model->rl_no], ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
        <?= Html::a('Rincian Pengeluaran', ['lelang-risalah/rpl-pdf', 'rl_no' => $model->rl_no], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?= Html::a('Tabel Perhitungan', ['lelang-risalah/tabel-pdf', 'rl_no' => $model->rl_no], ['class' => 'btn btn-default', 'target' => '_blank']) ?>
        
        <br><br>
<div class="panel panel-primary">
    <div class="panel-heading">Daftar Obyek Lelang pada Risalah Lelang ini</div>
    <div class="panel-content">
        <ol>
            <?php
            $daftar_obyek = LelangObyek::find()
                ->select(['*'])
                ->where(['rl_no'=>$model->rl_no])
                ->orderBy(['id'=>SORT_ASC])->all();
            foreach ($daftar_obyek as $daftar_obyek) {
                $obyek_lelang = $daftar_obyek->obyek_lelang;
                $obyek_lelang_sing = $daftar_obyek->obyek_lelang_sing;
                $pemohon_lelang = $daftar_obyek->pemohon_lelang;
                $id_obyek = $daftar_obyek->id;
                $rl_no = $daftar_obyek->rl_no;
                $data_rl = LelangRisalah::find()
                    ->select(['*'])
                    ->where(['rl_no'=>$rl_no])
                    ->one();
                    $rl_tgl = $data_rl->rl_tgl;
                $rph_pokok = $daftar_obyek->rph_pokok;
                $rph_lunas = $daftar_obyek->rph_lunas;
                $rph_batal = $daftar_obyek->rph_batal;
                $jurnal_rek = $daftar_obyek->jurnal_rek;
                $tgl_jurnal = $daftar_obyek->tgl_jurnal;
                $rph_wanprestasi = $daftar_obyek->rph_wanprestasi;
                $billing_pnbp = $daftar_obyek->billing_pnbp;
                $billing_ssp = $daftar_obyek->billing_ssp;
                $persen_pph = $daftar_obyek->persen_pph;
                $persen_penjual = $daftar_obyek->persen_penjual;
                $persen_pembeli = $daftar_obyek->persen_pembeli;
                $id_pemenang  = $daftar_obyek->id_pemenang;
                    $data_pemenang = LelangPemenang::find()
                    ->select(['*'])
                    ->where(['id'=>$id_pemenang])
                    ->one();
                    $nama_pemenang = $data_pemenang->nama_pemenang;
                    $alamat_pemenang = $data_pemenang->alamat_pemenang;
                 $id_setor_hbl  = $daftar_obyek->id_setor_hbl;
                    $data_hbl = LelangSetorHbl::find()
                    ->select(['*'])
                    ->where(['id'=>$id_setor_hbl])
                    ->one();
                    if ($id_setor_hbl) {
                        # code...
                        $rek_tujuan_no = $data_hbl->rek_tujuan_no;
                        $rek_tujuan_an = $data_hbl->rek_tujuan_an;
                        $penjual_alamat = $data_hbl->penjual_alamat;
                    }
                    else{
                        $rek_tujuan_no = "";
                        $rek_tujuan_an = "";
                        $penjual_alamat = "";
                    }


                $bl_penjual = ceil($persen_penjual/100*$rph_pokok);
                $bl_pembeli = ceil($persen_pembeli/100*$rph_pokok);
                $rph_pph = ceil($persen_pph/100*$rph_pokok);


                $rph_hbl = $rph_pokok-$bl_penjual-$rph_pph;

                $rph_jaminan = $daftar_obyek->rph_jaminan;
                $rph_hasil = $rph_pokok+$bl_pembeli+$rph_batal+$rph_wanprestasi;
                $rph_kekurangan = $rph_hasil-$rph_jaminan;
                $cek = $rph_kekurangan - $rph_lunas;

                $status_
                ?>
                <li><?=$obyek_lelang?> 
                    <br>
                    <code>Pemenang: <?=$nama_pemenang?></code>
                    <code>Pokok Lelang: Rp<?=number_format($rph_pokok,2,",",".")?></code>
                    <code>Pelunasan: Rp<?=number_format($rph_lunas,2,",",".")?></code>
                    <code>Billing PNBP: <?=$billing_pnbp?></code>
                    <code>Billing SSP: <?=$billing_ssp?></code>
                    <?php
                    if ($cek <> 0) {
                        ?>
                            <br>
                            Selisih Pelunasan - Kekurangan = 
                            <kbd>Rp<?=number_format($cek,2,",",".")?></kbd>
                            [Rp<?=number_format($rph_lunas,2,",",".")?> - Rp<?=number_format($rph_kekurangan,2,",",".")?>]
                        <?php
                    }
                    else{
                        echo "<br><kbd>Cek Pelunasan - OK</kbd>";
                    }
                    ?>
                    <br>
                    <?= Html::a('Ubah', ['lelang-obyek/update2', 'id' => $id_obyek, 'id_rl'=>$model->id], ['class' => 'btn btn-default']) ?>
                    <?= Html::a('Kuitansi', ['lelang-risalah/kui-pdf', 'id_obyek' => $id_obyek, 'size' => 11], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
                    <?= Html::a('Hapus', ['lelang-obyek/del-rl', 'id_obyek' => $id_obyek, 'rl_no' => $model->rl_no], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Mau menghapus obyek ini?',
                            'method' => 'post',
                        ],
                        ]) ?>
                    <button class="btn btn-info" data-toggle="collapse" data-target="#demo<?=$id_obyek?>">CoPas</button>

                    <div id="demo<?=$id_obyek?>" class="collapse">
                    
                    <hr>
                    <div class="container-fluid">
                    
                    <div class="panel panel-primary">
                    <br>
                    <div class="panel-content">


                    <div class="container-fluid">

                    <?php
                    $rph_pokok = Yii::$app->db
                        ->createCommand("SELECT sum(rph_pokok) 
                            FROM lelang_obyek 
                            where id = $id_obyek");
                    $jml_rph_pokok = $rph_pokok->queryScalar();
                    $rphPokok{$id_obyek} = $jml_rph_pokok;
                    $rphJaminan = $rph_jaminan;
                    $rphHbl = $rph_hbl;

                    $blPj = "BL Penjual, RL No.".$model->rl_no.", tgl.".$model->rl_tgl;
                    $blPb = "BL Pembeli, RL No.".$model->rl_no.", tgl.".$model->rl_tgl;
                    $blBatal = "BL Batal, ".$pemohon_lelang.", ".$obyek_lelang_sing." tgl.".$rl_tgl." CN No-".$jurnal_rek;
                    $blWanp = "UJL Wanprestasi, RL-".$rl_no." tgl.".$rl_tgl;
                    $urHbl = "HBL tgl ".$rl_tgl." RL ".$rl_no;

                    $rphPajak = $rph_pph;
                    $npwp = "003590718407000";
                    $id_pl = $model->id_pl;
                        #data pl
                        $data_pl = LelangPl::find()
                        ->select(['*'])
                        ->where(['id'=>$id_pl])
                        ->one();
                        $nama_pl = $data_pl->nama;
                        $nip_pl = $data_pl->nip;
                    $data_obyek = LelangObyek::find()
                    ->select(['*'])
                    ->where(['id' => $id_obyek])
                    ->one();
                    $pemohon_lelang = $data_obyek->pemohon_lelang;
                    $id_pemenang  = $data_obyek->id_pemenang;
                        $data_pemenang = LelangPemenang::find()
                        ->select(['*'])
                        ->where(['id'=>$id_pemenang])
                        ->one();
                        $nama_pemenang = $data_pemenang->nama_pemenang;
                    $pph = "PPh Final, RL No.".$model->rl_no.", tgl.".$model->rl_tgl.
                    " Pokok Lelang Rp".number_format($jml_rph_pokok,0,",",".").
                    ",- PL ".$nama_pl." NIP ".$nip_pl.
                    " Pemenang Lelang an. ".$nama_pemenang;
                    ?>

                    <h4>
                    <span class="label label-info">Pokok Lelang</span>
                        <span class="label label-success"><?=$rphPokok{$id_obyek} ?></span>
                        <br><br><span class="label label-default"><?=$blPj ?></span>
                        <br><br><span class="label label-default"><?=$blPb ?></span>
                        <br><br><span class="label label-default"><?=$blBatal ?></span>
                        <br><br><span class="label label-default"><?=$blWanp ?></span>
                        <span class="label label-success"><?=$rphJaminan = $rph_jaminan; ?></span>
                    <hr>
                    <span class="label label-info">Hasil Bersih</span>
                        <span class="label label-success"><?=$rphHbl ?></span>
                        <br><br><span class="label label-default"><?=$urHbl ?></span>
                    <hr>
                    <span class="label label-info">PPh Final</span>
                        <span class="label label-success"><?=$rphPajak ?></span>
                        <br><br><span class="label label-default"><?=$pph ?></span>
                        <br><br><span class="label label-default"><?=$npwp ?></span>
                    </h4>


                        <div class="panel panel-info">
                            <div class="panel-heading">Setor Kas Negara</div>
                            <div class="panel-content">
                                <div class="container-fluid">
                                    <hr>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">BL Penjual</span>
                                            <?php
                                            $blPj = "BL Penjual, RL No.".$model->rl_no.", tgl.".$model->rl_tgl;
                                            ?>
                                            <input 
                                            class ="form-control"
                                            type="text" 
                                            value="<?=$blPj?>"
                                            id="copyBlPj">
                                            <button class="btn btn-info" onclick="copyBlPj()">Copy</button>
                                            <script>
                                            function copyBlPj(){
                                                var copyText =
                                                document.getElementById("copyBlPj");
                                                copyText.select();
                                                document.execCommand("copy");
                                                alert("Copied: " + copyText.value);
                                            }                        
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">BL Pembeli</span>
                                            <?php
                                            $blPb = "BL Pembeli, RL No.".$model->rl_no.", tgl.".$model->rl_tgl;
                                            ?>
                                            <input 
                                            class ="form-control"
                                            type="text" 
                                            value="<?=$blPb?>" 
                                            id="copyBlPb">
                                            <button class="btn btn-info" onclick="copyBlPb()">Copy</button>
                                            <script>
                                            function copyBlPb(){
                                                var copyText =
                                                document.getElementById("copyBlPb");
                                                copyText.select();
                                                document.execCommand("copy");
                                                alert("Copied: " + copyText.value);
                                            }                        
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">PPh</span>
                                            <?php
                                            $rph_pokok = Yii::$app->db
                                                ->createCommand("SELECT sum(rph_pokok) 
                                                    FROM lelang_obyek 
                                                    where id = $id_obyek");
                                            $jml_rph_pokok = $rph_pokok->queryScalar();
                                            $id_pl = $model->id_pl;
                                                #data pl
                                                $data_pl = LelangPl::find()
                                                ->select(['*'])
                                                ->where(['id'=>$id_pl])
                                                ->one();
                                                $nama_pl = $data_pl->nama;
                                                $nip_pl = $data_pl->nip;
                                            $data_obyek = LelangObyek::find()
                                            ->select(['*'])
                                            ->where(['id' => $id_obyek])
                                            ->one();
                                            $pemohon_lelang = $data_obyek->pemohon_lelang;
                                            $id_pemenang  = $data_obyek->id_pemenang;
                                                $data_pemenang = LelangPemenang::find()
                                                ->select(['*'])
                                                ->where(['id'=>$id_pemenang])
                                                ->one();
                                                $nama_pemenang = $data_pemenang->nama_pemenang;
                                            $pph = "PPh Final, RL No.".$model->rl_no.", tgl.".$model->rl_tgl.
                                            " Pokok Lelang Rp".number_format($jml_rph_pokok,0,",",".").
                                            ",- PL ".$nama_pl." NIP ".$nip_pl.
                                            " Pemenang Lelang an. ".$nama_pemenang;
                                            ?>
                                            <input 
                                            class ="form-control"
                                            type="text" 
                                            value="<?=$pph?>" 
                                            id="copyPph">
                                            <button class="btn btn-info" onclick="copyPph()">Copy</button>
                                            <script>
                                            function copyPph(){
                                                var copyText =
                                                document.getElementById("copyPph");
                                                copyText.select();
                                                document.execCommand("copy");
                                                alert("Copied: " + copyText.value);
                                            }                        
                                            </script>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rph Pokok</span>
                                            <?php
                                            $rphPokok{$id_obyek} = $jml_rph_pokok;
                                            ?>
                                            <input 
                                            class ="form-control"
                                            type="text" 
                                            value="<?=$rphPokok{$id_obyek}?>"
                                            id="copyRphPokok<?= htmlspecialchars($id_obyek)?>">
                                            <button class="btn btn-info" onclick="copyRphPokok(<?=$id_obyek?>)">Copy</button>
                                        </div>
                                    </div>
                                    <script>
                                    function copyRphPokok($id_obyek){
                                        var copyText =
                                        document.getElementById("copyRphPokok(<?=$id_obyek?>)");
                                        copyText.select();
                                        document.execCommand("copy");
                                        alert("Copied: " + copyText.value);
                                    }                        
                                    </script>

                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rph Pajak</span>
                                            <?php
                                            $rphPajak = $rph_pph;
                                            ?>
                                            <input 
                                            class ="form-control"
                                            type="text" 
                                            value="<?=$rphPajak?>" 
                                            id="copyRphPajak">
                                            <button class="btn btn-info" onclick="copyRphPajak()">Copy</button>
                                        </div>
                                    </div>
                                    <script>
                                    function copyRphPajak(){
                                        var copyText =
                                        document.getElementById("copyRphPajak");
                                        copyText.select();
                                        document.execCommand("copy");
                                        alert("Copied: " + copyText.value);
                                    }                        
                                    </script>


                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">NPWP</span>
                                            <?php
                                            $npwp = "003590718407000";
                                            ?>
                                            <input 
                                            class ="form-control"
                                            type="text" 
                                            value="<?=$npwp?>" 
                                            id="copyNpwp">
                                            <button class="btn btn-info" onclick="copyNpwp()">Copy</button>
                                        </div>
                                    </div>
                                    <script>
                                    function copyNpwp(){
                                        var copyText =
                                        document.getElementById("copyNpwp");
                                        copyText.select();
                                        document.execCommand("copy");
                                        alert("Copied: " + copyText.value);
                                    }                        
                                    </script>
                                    <br>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">BL Batal</span>
                                            <?php
                                            $blBatal = "BL Batal, ".$pemohon_lelang.", ".$obyek_lelang_sing." tgl.".$rl_tgl." CN No-".$jurnal_rek;
                                            ?>
                                            <input 
                                            class ="form-control"
                                            type="text" 
                                            value="<?=$blBatal?>"
                                            id="copyBlBatal">
                                            <button class="btn btn-info" onclick="copyBlBatal()">Copy</button>
                                            <script>
                                            function copyBlBatal(){
                                                var copyText =
                                                document.getElementById("copyBlBatal");
                                                copyText.select();
                                                document.execCommand("copy");
                                                alert("Copied: " + copyText.value);
                                            }                        
                                            </script>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">BL Wanprestasi</span>
                                            <?php
                                            $blWanp = "UJL Wanprestasi, RL-".$rl_no." tgl.".$rl_tgl;
                                            ?>
                                            <input 
                                            class ="form-control"
                                            type="text" 
                                            value="<?=$blWanp?>"
                                            id="copyBlWanp">
                                            <button class="btn btn-info" onclick="copyBlWanp()">Copy</button>
                                            <script>
                                            function copyBlWanp(){
                                                var copyText =
                                                document.getElementById("copyBlWanp");
                                                copyText.select();
                                                document.execCommand("copy");
                                                alert("Copied: " + copyText.value);
                                            }                        
                                            </script>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rph Jaminan</span>
                                            <?php
                                            $rphJaminan = $rph_jaminan;
                                            ?>
                                            <input 
                                            class ="form-control"
                                            type="text" 
                                            value="<?=$rphJaminan?>"
                                            id="copyRphJaminan">
                                            <button class="btn btn-info" onclick="copyRphJaminan()">Copy</button>
                                            <script>
                                            function copyRphJaminan(){
                                                var copyText =
                                                document.getElementById("copyRphJaminan");
                                                copyText.select();
                                                document.execCommand("copy");
                                                alert("Copied: " + copyText.value);
                                            }                        
                                            </script>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="panel panel-info">
                            <div class="panel-heading">Setor HBL</div>
                            <div class="panel-content">
                                <div class="container-fluid">
                                    <hr>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">Ur HBL</span>
                                            <?php
                                            $urHbl = "HBL tgl ".$rl_tgl." RL ".$rl_no;
                                            ?>
                                            <input 
                                            class ="form-control"
                                            type="text" 
                                            value="<?=$urHbl?>" 
                                            id="copyUrHbl">
                                            <button class="btn btn-info" onclick="copyUrHbl()">Copy</button>
                                        </div>
                                    </div>
                                    <script>
                                    function copyUrHbl(){
                                        var copyText =
                                        document.getElementById("copyUrHbl");
                                        copyText.select();
                                        document.execCommand("copy");
                                        alert("Copied: " + copyText.value);
                                    }                        
                                    </script>

                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">Nomor Rek</span>
                                            <?php
                                            $rekHbl = $rek_tujuan_no;
                                            ?>
                                            <input 
                                            class ="form-control"
                                            type="text" 
                                            value="<?=$rekHbl?>" 
                                            id="copyRekHbl">
                                            <button class="btn btn-info" onclick="copyRekHbl()">Copy</button>
                                        </div>
                                    </div>
                                    <script>
                                    function copyRekHbl(){
                                        var copyText =
                                        document.getElementById("copyRekHbl");
                                        copyText.select();
                                        document.execCommand("copy");
                                        alert("Copied: " + copyText.value);
                                    }                        
                                    </script>

                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">An Rek</span>
                                            <?php
                                            $rekHblAn = $rek_tujuan_an;
                                            ?>
                                            <input 
                                            class ="form-control"
                                            type="text" 
                                            value="<?=$rekHblAn?>" 
                                            id="copyRekHblAn">
                                            <button class="btn btn-info" onclick="copyRekHblAn()">Copy</button>
                                        </div>
                                    </div>
                                    <script>
                                    function copyRekHblAn(){
                                        var copyText =
                                        document.getElementById("copyRekHblAn");
                                        copyText.select();
                                        document.execCommand("copy");
                                        alert("Copied: " + copyText.value);
                                    }                        
                                    </script>

                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">Alamat</span>
                                            <?php
                                            $alamatHbl = $penjual_alamat;
                                            ?>
                                            <input 
                                            class ="form-control"
                                            type="text" 
                                            value="<?=$alamatHbl?>" 
                                            id="copyRekAlamat">
                                            <button class="btn btn-info" onclick="copyRekAlamat()">Copy</button>
                                        </div>
                                    </div>
                                    <script>
                                    function copyRekAlamat(){
                                        var copyText =
                                        document.getElementById("copyRekAlamat");
                                        copyText.select();
                                        document.execCommand("copy");
                                        alert("Copied: " + copyText.value);
                                    }                        
                                    </script>

                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rph HBL</span>
                                            <?php
                                            $rphHbl = $rph_hbl;
                                            ?>
                                            <input 
                                            class ="form-control"
                                            type="text" 
                                            value="<?=$rphHbl?>" 
                                            id="copyRphHbl">
                                            <button class="btn btn-info" onclick="copyRphHbl()">Copy</button>
                                        </div>
                                    </div>
                                    <script>
                                    function copyRphHbl(){
                                        var copyText =
                                        document.getElementById("copyRphHbl");
                                        copyText.select();
                                        document.execCommand("copy");
                                        alert("Copied: " + copyText.value);
                                    }                        
                                    </script>

                                </div>
                                    <hr>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div></div></div>
                </li>
                <hr>
                <?php
            }
            ?>
        </ol>
    </div>
</div>

Tabel Perhitungan
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center bg-primary">No</th>
            <th class="text-center bg-primary">Obyek Lelang</th>
            <th class="text-center bg-primary">Pemenang</th>
            <th class="text-center bg-primary">Pokok Lelang</th>
            <th class="text-center bg-primary">Hasil Bersih</th>
            <th class="text-center bg-primary">BL Penjual</th>
            <th class="text-center bg-primary">BL Pembeli</th>
            <th class="text-center bg-primary">PPh</th>
            <th class="text-center bg-primary">Jaminan</th>
            <th class="text-center bg-primary">Pelunasan</th>
            <th class="text-center bg-primary">Hasil Lelang</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        $array_rph_pokok = array();
        $array_rph_bersih = array();
        $array_rph_bl_penjual = array();
        $array_rph_bl_pembeli = array();
        $array_rph_pph = array();
        $array_rph_batal = array();
        $array_rph_wanprestasi = array();
        $array_rph_hasil = array();
        $array_selisih = array();
        $array_rph_jaminan = array();
        $array_kekurangan = array();
        $daftar_rl = LelangObyek::find()
        ->select(['*'])
        ->where(['rl_no'=>$model->rl_no])
        // ->orderBy(['rl_no'=>SORT_ASC])
        ->all();
        foreach ($daftar_rl as $daftar_rl) {
            $rl_no = $daftar_rl->rl_no;
            $rph_pokok = $daftar_rl->rph_pokok;
            $id_obyek = $daftar_rl->id;
            $obyek_lelang  = $daftar_rl->obyek_lelang;
            $id_pemenang  = $daftar_rl->id_pemenang;
                $data_pemenang = LelangPemenang::find()
                ->select(['*'])
                ->where(['id'=>$id_pemenang])
                ->one();
                $nama_pemenang = $data_pemenang->nama_pemenang;
                $alamat_pemenang = $data_pemenang->alamat_pemenang;


            #perhitungan biaya
            $rph_pokok = Yii::$app->db
                ->createCommand("SELECT sum(rph_pokok) 
                    FROM lelang_obyek 
                    where id = $id_obyek");
            $jml_rph_pokok = $rph_pokok->queryScalar();

            $p_penjual = Yii::$app->db
                ->createCommand("SELECT avg(persen_penjual) 
                    FROM lelang_obyek 
                    where id = $id_obyek");
            $avg_p_penjual = $p_penjual->queryScalar();

            $p_pembeli = Yii::$app->db
                ->createCommand("SELECT avg(persen_pembeli) 
                    FROM lelang_obyek 
                    where id = $id_obyek");
            $avg_p_pembeli = $p_pembeli->queryScalar();

            $p_pph = Yii::$app->db
                ->createCommand("SELECT avg(persen_pph) 
                    FROM lelang_obyek 
                    where id = $id_obyek");
            $avg_p_pph = $p_pph->queryScalar();

            $rph_batal = Yii::$app->db
                ->createCommand("SELECT sum(rph_batal) 
                    FROM lelang_obyek 
                    where id = $id_obyek");
            $jml_rph_batal = $rph_batal->queryScalar();

            $rph_wanprestasi = Yii::$app->db
                ->createCommand("SELECT sum(rph_wanprestasi) 
                    FROM lelang_obyek 
                    where id = $id_obyek");
            $jml_rph_wanprestasi = $rph_wanprestasi->queryScalar();

            $bl_penjual = ceil($avg_p_penjual/100*$jml_rph_pokok);
            $bl_pembeli = ceil($avg_p_pembeli/100*$jml_rph_pokok);
            $pph = ceil($avg_p_pph/100*$jml_rph_pokok);

            $rph_bersih = $jml_rph_pokok-$bl_penjual-$pph;
            $rph_hasil = $jml_rph_pokok+$bl_pembeli+$jml_rph_batal+$jml_rph_wanprestasi;

            $rph_jaminan = Yii::$app->db
                ->createCommand("SELECT sum(rph_jaminan) 
                    FROM lelang_obyek 
                    where id = $id_obyek");
            $jml_rph_jaminan = $rph_jaminan->queryScalar();

            $rph_lunas = Yii::$app->db
                ->createCommand("SELECT sum(rph_lunas) 
                    FROM lelang_obyek 
                    where id = $id_obyek");
            $jml_rph_lunas = $rph_lunas->queryScalar();

            $rph_kekurangan = $rph_hasil-$jml_rph_jaminan;
            $selisih = $jml_rph_lunas - $rph_kekurangan;

            ?>
            <tr>
                <td><?=$no?></td>
                <td><?=$obyek_lelang?></td>
                <td><?=$nama_pemenang?></td>
                <td align="right"><?=number_format($jml_rph_pokok,0,",",".")?></td>
                <td align="right"><?=number_format($rph_bersih,0,",",".")?></td>
                <td align="right"><?=number_format($bl_penjual,0,",",".")?></td>
                <td align="right"><?=number_format($bl_pembeli,0,",",".")?></td>
                <td align="right"><?=number_format($pph,0,",",".")?></td>
                <td align="right"><?=number_format($jml_rph_jaminan,0,",",".")?></td>
                <td align="right"><?=number_format($rph_kekurangan,0,",",".")?></td>
                <td align="right"><?=number_format($rph_hasil,0,",",".")?></td>
            </tr>
            <?php
            $no++;
            array_push($array_rph_pokok, $jml_rph_pokok);
            array_push($array_rph_bersih, $rph_bersih);
            array_push($array_rph_bl_penjual, $bl_penjual);
            array_push($array_rph_bl_pembeli, $bl_pembeli);
            array_push($array_rph_pph, $pph);
            array_push($array_rph_batal, $jml_rph_batal);
            array_push($array_rph_wanprestasi, $jml_rph_wanprestasi);
            array_push($array_rph_hasil, $rph_hasil);
            array_push($array_selisih, $selisih);
            array_push($array_kekurangan, $rph_kekurangan);
            array_push($array_rph_jaminan, $jml_rph_jaminan);

        }
        ?>

            
        </tbody>
        <tr>
            <?php
            $total_rph_pokok = array_sum($array_rph_pokok);
            $total_rph_bersih = array_sum($array_rph_bersih);
            $total_rph_bl_penjual = array_sum($array_rph_bl_penjual);
            $total_rph_bl_pembeli = array_sum($array_rph_bl_pembeli);
            $total_rph_pph = array_sum($array_rph_pph);
            $total_rph_batal = array_sum($array_rph_batal);
            $total_rph_wanprestasi = array_sum($array_rph_wanprestasi);
            $total_rph_hasil = array_sum($array_rph_hasil);
            $total_selisih = array_sum($array_selisih);
            $total_kekurangan = array_sum($array_kekurangan);
            $total_rph_jaminan = array_sum($array_rph_jaminan);
            ?>
            <td class="text-center bg-info"  colspan="3"> Jumlah </td>
            <td class="text-right bg-info" ><?=number_format($total_rph_pokok,0,",",".")?></td>
            <td class="text-right bg-info" ><?=number_format($total_rph_bersih,0,",",".")?></td>
            <td class="text-right bg-info"  ><?=number_format($total_rph_bl_penjual,0,",",".")?></td>
            <td class="text-right bg-info"  ><?=number_format($total_rph_bl_pembeli,0,",",".")?></td>
            <td class="text-right bg-info"  ><?=number_format($total_rph_pph,0,",",".")?></td>
            <td class="text-right bg-info"  ><?=number_format($total_rph_jaminan,0,",",".")?></td>
            <td class="text-right bg-info"  ><?=number_format($total_kekurangan,0,",",".")?></td>
            <td class="text-right bg-info"  ><?=number_format($total_rph_hasil,0,",",".")?></td>
        </tr>
    </table>
</table>

</div>
