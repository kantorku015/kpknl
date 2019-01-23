<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use backend\models\LelangObyek;
use yii\helpers\Html;

if (isset($_GET['pemohon'])) {
    # code...
    $pemohon = $_GET['pemohon'];
}
else{
    $pemohon = "";
}

$this->title = "Rekap Risalah Lelang | ".$pemohon;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= Html::beginForm('','get',['class' => 'form-inline'])?>
    <div class="row">
    <div class="col-md-12">
        <select class="form-control" name="pemohon">
            <?php
            $ref_pemohon = LelangObyek::find()
            ->select(['pemohon_lelang'])
            ->distinct()
            ->orderBy(['pemohon_lelang'=>SORT_ASC])
            ->all();
            foreach ($ref_pemohon as $ref_pemohon) {
                $pemohon_lelang = $ref_pemohon->pemohon_lelang;
                ?>
                <option><?=$pemohon_lelang?></option>
                <?php
            }
            ?>
        </select>
        <?= Html::submitButton('<span class="glyphicon glyphicon-ok"> </span>',['class' => 'btn btn-success']) ?>
    </div>  
    </div>
    <?= Html::endForm()?>

<hr>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center bg-primary">No</th>
                <th class="text-center bg-primary">RL</th>
                <th class="text-center bg-primary">Pokok Lelang</th>
                <th class="text-center bg-primary">Hasil Bersih</th>
                <th class="text-center bg-primary">BL Penjual</th>
                <th class="text-center bg-primary">PPh</th>
                <th class="text-center bg-primary">BL Pembeli</th>
                <th class="text-center bg-primary">BL Batal</th>
                <th class="text-center bg-primary">UJL Wanprestasi</th>
                <th class="text-center bg-primary">Hasil Lelang</th>
                <th class="text-center bg-primary">Selisih Pembulatan</th>
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
        ->where(['pemohon_lelang'=>$pemohon])
        ->orderBy(['rl_no'=>SORT_ASC])
        ->all();
        foreach ($daftar_rl as $daftar_rl) {
            $rl_no = $daftar_rl->rl_no;
            $rph_pokok = $daftar_rl->rph_pokok;
            $id_obyek = $daftar_rl->id;

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
                <td><?=$rl_no?></td>
                <td align="right"><?=number_format($jml_rph_pokok,0,",",".")?></td>
                <td align="right"><?=number_format($rph_bersih,0,",",".")?></td>
                <td align="right"><?=number_format($bl_penjual,0,",",".")?></td>
                <td align="right"><?=number_format($pph,0,",",".")?></td>
                <td align="right"><?=number_format($bl_pembeli,0,",",".")?></td>
                <td align="right"><?=number_format($jml_rph_batal,0,",",".")?></td>
                <td align="right"><?=number_format($jml_rph_wanprestasi,0,",",".")?></td>
                <td align="right"><?=number_format($rph_hasil,0,",",".")?></td>
                <td align="right"><?=number_format($selisih,0,",",".")?></td>
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
            ?>
            <td class="text-center bg-info"  colspan="2"> Jumlah </td>
            <td class="text-right bg-info" ><?=number_format($total_rph_pokok,0,",",".")?></td>
            <td class="text-right bg-info" ><?=number_format($total_rph_bersih,0,",",".")?></td>
            <td class="text-right bg-info"  ><?=number_format($total_rph_bl_penjual,0,",",".")?></td>
            <td class="text-right bg-info"  ><?=number_format($total_rph_pph,0,",",".")?></td>
            <td class="text-right bg-info"  ><?=number_format($total_rph_bl_pembeli,0,",",".")?></td>
            <td class="text-right bg-info"  ><?=number_format($total_rph_batal,0,",",".")?></td>
            <td class="text-right bg-info"  ><?=number_format($total_rph_wanprestasi,0,",",".")?></td>
            <td class="text-right bg-info"  ><?=number_format($total_rph_hasil,0,",",".")?></td>
            <td class="text-right bg-info"  ><?=number_format($total_selisih,0,",",".")?>
            <br>
            <?=number_format($total_selisih+$total_rph_bl_pembeli,0,",",".")?></td>
        </tr>
    </table>

</div>
