<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use backend\models\LelangObyek;
use backend\models\LelangStatus;
use backend\models\LelangRisalah;
use backend\models\Bulan;
use yii\helpers\Html;

if (isset($_GET['nama'])) {
    # code...
    $nama = $_GET['nama'];
}
else{
    $nama = "Januari";
}
 $data_bulan = Bulan::find()
    ->select(['*'])
    ->where(['nama'=>$nama])
    ->one();
    $id_bulan = $data_bulan->id_bulan;
// $this->title = "Rekap Risalah Lelang | ".$pemohon;
// $this->title = "Rekap Penyetoran Hasil Lelang Bulan ".$nama;
$this->title = "Rekap Penyetoran Hasil Lelang";
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::beginForm('','get',['class' => 'form-inline'])?>
        <div class="row">
        <div class="col-md-12">
            <select class="form-control" name="nama">
                <?php
                $ref_bulan = Bulan::find()
                ->select(['*'])
                ->distinct()
                ->orderBy(['id_bulan'=>SORT_ASC])
                ->all();
                foreach ($ref_bulan as $ref_bulan) {
                    $nama = $ref_bulan->nama;
                    ?>
                    <option><?=$nama?></option>
                    <?php
                }
                ?>
            </select>
            <?= Html::submitButton('<span class="glyphicon glyphicon-ok"> </span>',['class' => 'btn btn-success']) ?>
        </div>  
        </div>
    <?= Html::endForm()?>

<hr>
<kbd>Note:</kbd> Nomor RL dengan <code>6 digit kode acak</code> hanya sebagai nomor untuk identifikasi data.
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center bg-primary">No</th>
                <th class="text-center bg-primary">Status</th>
                <th class="text-center bg-primary">Nomor RL</th>
                <th class="text-center bg-primary">Tgl RL</th>
                <th class="text-center bg-primary">Nomor Kuitansi</th>
                <th class="text-center bg-primary">Tgl Pelunasan</th>
                <th class="text-center bg-primary">Tgl Setor HBL</th>
                <th class="text-center bg-primary">Tgl Setor PNBP</th>
                <th class="text-center bg-primary">Billing PNBP</th>
                <th class="text-center bg-primary">Hasil Bersih</th>
                <th class="text-center bg-primary">BL Penjual</th>
                <th class="text-center bg-primary">BL Pembeli</th>
                <th class="text-center bg-primary">PPh Final</th>
                <th class="text-center bg-primary">Bea Pembatalan</th>
                <th class="text-center bg-primary">UJ Wanprestasi</th>
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
        $daftar_rl = LelangObyek::find()
        ->select(['*'])
        // ->where('MONTH("rl_tgl") = '.$id_bulan)
        ->orderBy([
            'rl_no'=>SORT_ASC, 
            // 'rl_tgl'=>SORT_ASC
            ])
        ->all();
        foreach ($daftar_rl as $daftar_rl) {
            $rl_no = $daftar_rl->rl_no;
            $kuitansi_no = $daftar_rl->kuitansi_no;
            $billing_pnbp = $daftar_rl->billing_pnbp;
                $data_rl = LelangRisalah::find()
                    ->select(['*'])
                    ->where(['rl_no' => $rl_no])
                    ->one();
                    if ($data_rl) {
                        # code...
                    $rl_tgl = $data_rl->rl_tgl;
                        $data_bulan = Bulan::find()
                            ->select(['*'])
                            ->where(['id_bulan'=>date_format(date_create($rl_tgl),"m")])
                            ->one();
                            $bulan_rl = $data_bulan->nama;
                            $tanggal_rl = date_format(date_create($rl_tgl),"d")." ".$bulan_rl." ".date_format(date_create($rl_tgl),"Y");
                    }
                    else{
                        $rl_tgl = "rl_tgl";
                        $bulan_rl = "bulan_rl";
                        $tanggal_rl = "tanggal_rl";
                    }
            $status_lelang = $daftar_rl->status_lelang;
                $data_status_lelang = LelangStatus::find()
                ->select(['*'])
                ->where(['id'=>$status_lelang])
                ->one();
                    $ur_status = $data_status_lelang->ur_status;
                
            $rph_pokok = $daftar_rl->rph_pokok;
            $tgl_jurnal = $daftar_rl->tgl_jurnal;
                $data_bulan_jurnal = Bulan::find()
                ->select(['*'])
                ->where(['id_bulan'=>date_format(date_create($tgl_jurnal),"m")])
                ->one();
                $bulan_jurnal = $data_bulan_jurnal->nama;
                if ($tgl_jurnal) {
                    $tanggal_jurnal = date_format(date_create($tgl_jurnal),"d")." ".$bulan_jurnal." ".date_format(date_create($tgl_jurnal),"Y");
                }
                else{
                    $tanggal_jurnal = '-';
                }

            $selisih_lunas_dengan_rl = $tanggal_jurnal - $tanggal_rl;

            $tgl_setor_hbl = $daftar_rl->tgl_setor_hbl;
                $data_bulan_hbl = Bulan::find()
                ->select(['*'])
                ->where(['id_bulan'=>date_format(date_create($tgl_setor_hbl),"m")])
                ->one();
                $bulan_hbl = $data_bulan_hbl->nama;
                if ($tgl_setor_hbl) {
                    $tanggal_hbl = date_format(date_create($tgl_setor_hbl),"d")." ".$bulan_hbl." ".date_format(date_create($tgl_setor_hbl),"Y");
                }
                else{
                    $tanggal_hbl = '-';
                }

            $tgl_setor_pnbp = $daftar_rl->tgl_setor_pnbp;
                $data_bulan_pnbp = Bulan::find()
                ->select(['*'])
                ->where(['id_bulan'=>date_format(date_create($tgl_setor_pnbp),"m")])
                ->one();
                $bulan_pnbp = $data_bulan_pnbp->nama;
                if ($tgl_setor_pnbp) {
                    $tanggal_pnbp = date_format(date_create($tgl_setor_pnbp),"d")." ".$bulan_pnbp." ".date_format(date_create($tgl_setor_pnbp),"Y");
                }
                else{
                    $tanggal_pnbp = '-';
                }

            #perhitungan uang
            $rph_pokok = Yii::$app->db
                ->createCommand("SELECT sum(rph_pokok) 
                    FROM lelang_obyek 
                    where rl_no = '$rl_no'");
            $jml_rph_pokok = $rph_pokok->queryScalar();

            $p_penjual = Yii::$app->db
                ->createCommand("SELECT avg(persen_penjual) 
                    FROM lelang_obyek 
                    where rl_no = '$rl_no'");
            $avg_p_penjual = $p_penjual->queryScalar();

            $p_pembeli = Yii::$app->db
                ->createCommand("SELECT avg(persen_pembeli) 
                    FROM lelang_obyek 
                    where rl_no = '$rl_no'");
            $avg_p_pembeli = $p_pembeli->queryScalar();

            $p_pph = Yii::$app->db
                ->createCommand("SELECT avg(persen_pph) 
                    FROM lelang_obyek 
                    where rl_no = '$rl_no'");
            $avg_p_pph = $p_pph->queryScalar();

            $rph_batal = Yii::$app->db
                ->createCommand("SELECT sum(rph_batal) 
                    FROM lelang_obyek 
                    where rl_no = '$rl_no'");
            $jml_rph_batal = $rph_batal->queryScalar();

            $rph_wanprestasi = Yii::$app->db
                ->createCommand("SELECT sum(rph_wanprestasi) 
                    FROM lelang_obyek 
                    where rl_no = '$rl_no'");
            $jml_rph_wanprestasi = $rph_wanprestasi->queryScalar();

           $bl_penjual = ceil($avg_p_penjual/100*$jml_rph_pokok);
            $bl_pembeli = ceil($avg_p_pembeli/100*$jml_rph_pokok);
            $pph = ceil($avg_p_pph/100*$jml_rph_pokok);


            // $bl_penjual = round($avg_p_penjual/100*$jml_rph_pokok, 0, PHP_ROUND_HALF_UP);
            // $bl_pembeli = round($avg_p_pembeli/100*$jml_rph_pokok, 0, PHP_ROUND_HALF_UP);
            // $pph = round($avg_p_pph/100*$jml_rph_pokok, 0, PHP_ROUND_HALF_UP);


            $rph_bersih = $jml_rph_pokok-$bl_penjual-$pph;
            $rph_hasil = $jml_rph_pokok+$bl_pembeli+$jml_rph_batal+$jml_rph_wanprestasi;

            $rph_jaminan = Yii::$app->db
                ->createCommand("SELECT sum(rph_jaminan) 
                    FROM lelang_obyek 
                    where rl_no = '$rl_no'");
            $jml_rph_jaminan = $rph_jaminan->queryScalar();

            $rph_kekurangan = $rph_hasil-$jml_rph_jaminan;

            ?>
            <tr>
                <td><?=$no?>.</td>
                <td><?=$ur_status?></td>
                <?php
                if ($status_lelang <> 3) {
                    ?>
                    <td><?=$rl_no?></td>
                    <?php
                }
                else{
                    ?>
                    <td><code><?=$rl_no?></code></td>
                    <?php
                }
                ?>
                <td><?=$tanggal_rl?></td>
                <td><?=$kuitansi_no?></td>
                <td><?=$tanggal_jurnal?></td>
                <td><?=$tanggal_hbl?></td>
                <td><?=$tanggal_pnbp?></td>
                <td><?=$billing_pnbp?></td>
                <td align="right"><?=number_format($rph_bersih,0,",",".")?></td>
                <td align="right"><?=number_format($bl_penjual,0,",",".")?></td>
                <td align="right"><?=number_format($bl_pembeli,0,",",".")?></td>
                <td align="right"><?=number_format($pph,0,",",".")?></td>
                <td align="right"><?=number_format($jml_rph_batal,0,",",".")?></td>
                <td align="right"><?=number_format($jml_rph_wanprestasi,0,",",".")?></td>
                <td align="right"><?=number_format($rph_hasil,0,",",".")?></td>
            </tr>
            <?php
            $no++;
        }
        ?>
        </tbody>
    </table>

</div>
