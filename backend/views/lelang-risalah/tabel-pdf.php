<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\LelangObyek;
use backend\models\LelangPl;
use backend\models\LelangPemenang;
use backend\models\LelangRisalah;
use backend\models\LelangSetorHbl;

require(__DIR__ . '/../../../tools/mpdf60/mpdf.php');
require(__DIR__ . '/../../../tools/terbilang.php');
// $img = '/../../lelang/tools/kop.jpg';
$img = '/img/kop.jpg';
$size = $_GET['size'];
$this->title = 'RPN';

// $mpdf = new mPDF('utf-8', 'A4-P', 11, '', 15, 10);
$mpdf = new mPDF('utf-8', 'A4-L', $size, '', 15, 10);
$mpdf->simpleTables = true;
$mpdf->AliasNbPages('pagetotal');
$mpdf->SetFooter('hal. '.'{PAGENO} / pagetotal');

$rl_no = $_GET['rl_no'];
            // $daftar_obyek = LelangObyek::find()
            //     ->select(['*'])
            //     ->where(['rl_no'=>$model->rl_no])
            //     ->orderBy(['id'=>SORT_ASC])->all();
            // foreach ($daftar_obyek as $daftar_obyek) {
            //     $obyek_lelang = $daftar_obyek->obyek_lelang;
            //     $obyek_lelang_sing = $daftar_obyek->obyek_lelang_sing;
            //     $pemohon_lelang = $daftar_obyek->pemohon_lelang;
            //     $id_obyek = $daftar_obyek->id;
            //     $rl_no = $daftar_obyek->rl_no;
            //     $data_rl = LelangRisalah::find()
            //         ->select(['*'])
            //         ->where(['rl_no'=>$rl_no])
            //         ->one();
            //         $rl_tgl = $data_rl->rl_tgl;
            //     $rph_pokok = $daftar_obyek->rph_pokok;
            //     $rph_lunas = $daftar_obyek->rph_lunas;
            //     $rph_batal = $daftar_obyek->rph_batal;
            //     $jurnal_rek = $daftar_obyek->jurnal_rek;
            //     $tgl_jurnal = $daftar_obyek->tgl_jurnal;
            //     $rph_wanprestasi = $daftar_obyek->rph_wanprestasi;
            //     $billing_pnbp = $daftar_obyek->billing_pnbp;
            //     $billing_ssp = $daftar_obyek->billing_ssp;
            //     $persen_pph = $daftar_obyek->persen_pph;
            //     $persen_penjual = $daftar_obyek->persen_penjual;
            //     $persen_pembeli = $daftar_obyek->persen_pembeli;
            //     $id_pemenang  = $daftar_obyek->id_pemenang;
            //         $data_pemenang = LelangPemenang::find()
            //         ->select(['*'])
            //         ->where(['id'=>$id_pemenang])
            //         ->one();
            //         $nama_pemenang = $data_pemenang->nama_pemenang;
            //         $alamat_pemenang = $data_pemenang->alamat_pemenang;
            //      $id_setor_hbl  = $daftar_obyek->id_setor_hbl;
            //         $data_hbl = LelangSetorHbl::find()
            //         ->select(['*'])
            //         ->where(['id'=>$id_setor_hbl])
            //         ->one();
            //         if ($id_setor_hbl) {
            //             # code...
            //             $rek_tujuan_no = $data_hbl->rek_tujuan_no;
            //             $rek_tujuan_an = $data_hbl->rek_tujuan_an;
            //             $penjual_alamat = $data_hbl->penjual_alamat;
            //         }
            //         else{
            //             $rek_tujuan_no = "";
            //             $rek_tujuan_an = "";
            //             $penjual_alamat = "";
            //         }

            //     #perhitungan biaya
            //     // $rph_pokok = Yii::$app->db
            //     //     ->createCommand("SELECT sum(rph_pokok) 
            //     //         FROM lelang_obyek 
            //     //         where id = $id_obyek");
            //     // $jml_rph_pokok = $rph_pokok->queryScalar();

            //     // $p_penjual = Yii::$app->db
            //     //     ->createCommand("SELECT avg(persen_penjual) 
            //     //         FROM lelang_obyek 
            //     //         where id = $id_obyek");
            //     // $avg_p_penjual = $p_penjual->queryScalar();

            //     // $p_pembeli = Yii::$app->db
            //     //     ->createCommand("SELECT avg(persen_pembeli) 
            //     //         FROM lelang_obyek 
            //     //         where id = $id_obyek");
            //     // $avg_p_pembeli = $p_pembeli->queryScalar();

            //     // $p_pph = Yii::$app->db
            //     //     ->createCommand("SELECT avg(persen_pph) 
            //     //         FROM lelang_obyek 
            //     //         where id = $id_obyek");
            //     // $avg_p_pph = $p_pph->queryScalar();

            //     // $rph_batal = Yii::$app->db
            //     //     ->createCommand("SELECT sum(rph_batal) 
            //     //         FROM lelang_obyek 
            //     //         where id = $id_obyek");
            //     // $jml_rph_batal = $rph_batal->queryScalar();

            //     // $rph_wanprestasi = Yii::$app->db
            //     //     ->createCommand("SELECT sum(rph_wanprestasi) 
            //     //         FROM lelang_obyek 
            //     //         where id = $id_obyek");
            //     // $jml_rph_wanprestasi = $rph_wanprestasi->queryScalar();

            //     $bl_penjual = ceil($persen_penjual/100*$rph_pokok);
            //     $bl_pembeli = ceil($persen_pembeli/100*$rph_pokok);
            //     $rph_pph = ceil($persen_pph/100*$rph_pokok);

            //     // $bl_penjual = round($persen_penjual/100*$rph_pokok, 0, PHP_ROUND_HALF_UP);
            //     // $bl_pembeli = round($persen_pembeli/100*$rph_pokok, 0, PHP_ROUND_HALF_UP);
            //     // $rph_pph = round($persen_pph/100*$rph_pokok, 0, PHP_ROUND_HALF_UP);

            //     $rph_hbl = $rph_pokok-$bl_penjual-$rph_pph;

            //     $rph_jaminan = $daftar_obyek->rph_jaminan;
            //     $rph_hasil = $rph_pokok+$bl_pembeli+$rph_batal+$rph_wanprestasi;
            //     $rph_kekurangan = $rph_hasil-$rph_jaminan;
            //     $cek = $rph_kekurangan - $rph_lunas;


$isi .= "TABEL PERHITUNGAN";
// $isi .= "<table>";
// $isi .= "<table class=\"table table-striped table-hover table-bordered\">";
// $isi .= "<table border=\"10\" cellpadding=\"1\" cellspacing=\"1\" style=\"width: 500px;\">";
$isi .= "<table style=\"border-collapse\" cellpadding=\"1\" cellspacing=\"1\">";
        $isi .= "<tr>";
            $isi .= "<td>No</td>";
            $isi .= "<td align=\"center\">Obyek Lelang</td>";
            // $isi .= "<td>Pemenang</td>";
            $isi .= "<td align=\"center\">Pokok Lelang</td>";
            $isi .= "<td align=\"center\">Hasil Bersih</td>";
            $isi .= "<td align=\"center\">BL Penjual</td>";
            $isi .= "<td align=\"center\">BL Pembeli</td>";
            $isi .= "<td align=\"center\">PPh</td>";
            $isi .= "<td align=\"center\">Jaminan</td>";
            $isi .= "<td align=\"center\">Pelunasan</td>";
            $isi .= "<td align=\"center\">Hasil Lelang</td>";
        $isi .= "</tr>";


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
        ->where(['rl_no'=>$rl_no])
        // ->orderBy(['rl_no'=>SORT_ASC])
        ->all();
        foreach ($daftar_rl as $daftar_rl) {
            $rl_no = $daftar_rl->rl_no;
            $rph_pokok = $daftar_rl->rph_pokok;
            $id_obyek = $daftar_rl->id;
                 // $data_obyek = LelangObyek::find()
                 //    ->select(['*'])
                 //    ->where(['rl_no'=>$rl_no])
                 //    ->one();
                    $obyek_lelang = $daftar_rl->obyek_lelang;
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

            $isi .= "<tr>";
                $isi .= "<td valign=\"top\">".$no."</td>";
                $isi .= "<td valign=\"top\"><b>".$nama_pemenang."</b><br>".$obyek_lelang."</td>";
                // $isi .= "<td valign=\"top\">".$nama_pemenang."</td>";
                $isi .= "<td align=\"right\" valign=\"top\">".number_format($jml_rph_pokok,0,",",".")."</td>";
                $isi .= "<td align=\"right\" valign=\"top\">".number_format($rph_bersih,0,",",".")."</td>";
                $isi .= "<td align=\"right\" valign=\"top\">".number_format($bl_penjual,0,",",".")."</td>";
                $isi .= "<td align=\"right\" valign=\"top\">".number_format($bl_pembeli,0,",",".")."</td>";
                $isi .= "<td align=\"right\" valign=\"top\">".number_format($pph,0,",",".")."</td>";
                $isi .= "<td align=\"right\" valign=\"top\">".number_format($jml_rph_jaminan,0,",",".")."</td>";
                $isi .= "<td align=\"right\" valign=\"top\">".number_format($rph_kekurangan,0,",",".")."</td>";
                $isi .= "<td align=\"right\" valign=\"top\">".number_format($rph_hasil,0,",",".")."</td>";
            $isi .= "</tr>";
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

            
        $isi .= "<tr>";
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
            $isi .= "<td align=\"center\"  colspan=\"2\"> Jumlah </td>";
            $isi .= "<td align=\"right\" >".number_format($total_rph_pokok,0,",",".")."</td>";
            $isi .= "<td align=\"right\" >".number_format($total_rph_bersih,0,",",".")."</td>";
            $isi .= "<td align=\"right\"  >".number_format($total_rph_bl_penjual,0,",",".")."</td>";
            $isi .= "<td align=\"right\"  >".number_format($total_rph_bl_pembeli,0,",",".")."</td>";
            $isi .= "<td align=\"right\"  >".number_format($total_rph_pph,0,",",".")."</td>";
            $isi .= "<td align=\"right\"  >".number_format($total_rph_jaminan,0,",",".")."</td>";
            $isi .= "<td align=\"right\"  >".number_format($total_kekurangan,0,",",".")."</td>";
            $isi .= "<td align=\"right\"  >".number_format($total_rph_hasil,0,",",".")."</td>";
        $isi .= "</tr>";
    $isi .= "</table>";

$mpdf->WriteHTML($isi);
$mpdf->Output('Tabel'.$rl_no,'I');
exit;
?>