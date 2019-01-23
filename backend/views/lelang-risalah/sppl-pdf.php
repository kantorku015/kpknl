<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\LelangRisalah;
use backend\models\LelangPemenang;
use backend\models\LelangPl;
use backend\models\LelangJenis;
use backend\models\LelangObyek;
use backend\models\Bulan;
use backend\models\LelangObyekJenis;
require(__DIR__ . '/../../../tools/mpdf60/mpdf.php');
require(__DIR__ . '/../../../tools/terbilang.php');
// include '/../../lelang/tools/terbilang.php';
// $img = '/../../lelang/tools/kop.jpg';
$img = '/img/kop.jpg';

$mpdf = new mPDF('utf-8', 'A4-P', 10, '', 15, 10);
$mpdf->simpleTables = true;
$mpdf->AliasNbPages('pagetotal');
// $mpdf->SetFooter('{PAGENO} / pagetotal');


$id_rl = $_GET['id_rl'];
#risalah lelang
$data_rl = LelangRisalah::find()
->select(['*'])
->where(['id' => $id_rl])
->one();
$rl_no = $data_rl->rl_no;
$rl_tgl = $data_rl->rl_tgl;
$id_pl = $data_rl->id_pl;
    #data pl
    $data_pl = LelangPl::find()
    ->select(['*'])
    ->where(['id'=>$id_pl])
    ->one();
    $nama_pl = $data_pl->nama;
    $nip_pl = $data_pl->nip;
$sppl_no = $data_rl->sppl_no;
$sppl_tgl = $data_rl->sppl_tgl;
    $data_bulan_sppl = Bulan::find()
    ->select(['*'])
    ->where(['id_bulan'=>date_format(date_create($sppl_tgl),"m")])
    ->one();
$bulan_sppl = $data_bulan_sppl->nama;
$hari_sppl = date_format(date_create($sppl_tgl),"D");
    switch ($hari_sppl) {
        case 'Sun':
            $hari_sppl = "Minggu";
            break;
        case 'Mon':
            $hari_sppl = "Senin";
            break;
        case 'Tue':
            $hari_sppl = "Selasa";
            break;
        case 'Wed':
            $hari_sppl = "Rabu";
            break;
        case 'Thu':
            $hari_sppl = "Kamis";
            break;
        case 'Fri':
            $hari_sppl = "Jumat";
            break;
        case 'Sat':
            $hari_sppl = "Sabtu";
            break;
        
        default:
            $hari_sppl = "hari";
            break;
    }
$tanggal_sppl = date_format(date_create($sppl_tgl),"d")." ".$bulan_sppl." ".date_format(date_create($sppl_tgl),"Y");


$data_bulan = Bulan::find()
->select(['*'])
->where(['id_bulan'=>date_format(date_create($rl_tgl),"m")])
->one();
$bulan_rl = $data_bulan->nama;
$tanggal_rl = date_format(date_create($rl_tgl),"d")." ".$bulan_rl." ".date_format(date_create($rl_tgl),"Y");

 $data_obyek = LelangObyek::find()
    ->select(['*'])
    ->where(['rl_no' => $id_rl])
    ->one();
    $pemohon_lelang = $data_obyek->pemohon_lelang;
    $id_pemenang  = $data_obyek->id_pemenang;
        $data_pemenang = LelangPemenang::find()
        ->select(['*'])
        ->where(['id'=>$id_pemenang])
        ->one();
        $nama_pemenang = $data_pemenang->nama_pemenang;
        $alamat_pemenang = $data_pemenang->alamat_pemenang;
    $id_jenis_lelang = $data_obyek->jenis_lelang;
        $data_jenis_lelang = LelangJenis::find()
        ->select(['*'])
        ->where(['id'=>$id_jenis_lelang])
        ->one();
        $ur_jenis = $data_jenis_lelang->ur_jenis;
    $obyek_lelang = $data_obyek->obyek_lelang;
    
    #perhitungan biaya
    $rph_pokok = Yii::$app->db
        ->createCommand("SELECT sum(rph_pokok) 
            FROM lelang_obyek 
            where rl_no = $id_rl");
    $jml_rph_pokok = $rph_pokok->queryScalar();

    $p_penjual = Yii::$app->db
        ->createCommand("SELECT avg(persen_penjual) 
            FROM lelang_obyek 
            where rl_no = $id_rl");
    $avg_p_penjual = $p_penjual->queryScalar();

    $p_pembeli = Yii::$app->db
        ->createCommand("SELECT avg(persen_pembeli) 
            FROM lelang_obyek 
            where rl_no = $id_rl");
    $avg_p_pembeli = $p_pembeli->queryScalar();

    $p_pph = Yii::$app->db
        ->createCommand("SELECT avg(persen_pph) 
            FROM lelang_obyek 
            where rl_no = $id_rl");
    $avg_p_pph = $p_pph->queryScalar();

    $rph_batal = Yii::$app->db
        ->createCommand("SELECT sum(rph_batal) 
            FROM lelang_obyek 
            where rl_no = $id_rl");
    $jml_rph_batal = $rph_batal->queryScalar();

    $rph_wanprestasi = Yii::$app->db
        ->createCommand("SELECT sum(rph_wanprestasi) 
            FROM lelang_obyek 
            where rl_no = $id_rl");
    $jml_rph_wanprestasi = $rph_wanprestasi->queryScalar();

    $bl_penjual = ceil($avg_p_penjual/100*$jml_rph_pokok);
    $bl_pembeli = ceil($avg_p_pembeli/100*$jml_rph_pokok);
    $pph = ceil($avg_p_pph/100*$jml_rph_pokok);

    $rph_bersih = $jml_rph_pokok-$bl_penjual-$pph;
    $rph_hasil = $jml_rph_pokok+$bl_pembeli+$jml_rph_batal+$jml_rph_wanprestasi;
    

    $rph_jaminan = Yii::$app->db
        ->createCommand("SELECT sum(rph_jaminan) 
            FROM lelang_obyek 
            where rl_no = $id_rl");
    $jml_rph_jaminan = $rph_jaminan->queryScalar();

    $rph_lunas = Yii::$app->db
        ->createCommand("SELECT sum(rph_lunas) 
            FROM lelang_obyek 
            where rl_no = $id_rl");
    $jml_rph_lunas = $rph_lunas->queryScalar();

    $rph_kekurangan = $rph_hasil-$jml_rph_jaminan;

$isi = "";

    $isi .= "<table>";
        $isi .= "<tr>";
            $isi .= "<td align=\"center\"> <img src=\"$img\")> </td>";
        $isi .= "</tr>";
    $isi .= "</table>";
    $isi .= "<p align=\"center\"><b><u>SURAT PENUNJUKAN PEMENANG LELANG</u></b></p>";
    $isi .= "<p align=\"center\"><b>Nomor: ".$sppl_no."/31/2018</b></p>";

    $isi .= "<p> Pada hari ini, ".$hari_sppl." tanggal ".$tanggal_sppl.", Saya yang bertanda tangan di bawah ini:</p>";
    $isi .= "<table>";
        $isi .= "<tr>";
            $isi .= "<td>Nama</td>";
            $isi .= "<td>&nbsp;&nbsp;:</td>";
            $isi .= "<td>&nbsp;&nbsp;".$nama_pl."</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td>NIP</td>";
            $isi .= "<td>&nbsp;&nbsp;:</td>";
            $isi .= "<td>&nbsp;&nbsp;".$nip_pl."</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td>Jabatan</td>";
            $isi .= "<td>&nbsp;&nbsp;:</td>";
            $isi .= "<td>&nbsp;&nbsp;Pejabat Lelang</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td valign=\"top\">Alamat</td>";
            $isi .= "<td valign=\"top\">&nbsp;&nbsp;:</td>";
            $isi .= "<td>&nbsp;&nbsp;Kantor Pelayanan Kekayaan Negara dan Lelang Bekasi";
                $isi .= "<br>";
                $isi .= "&nbsp;&nbsp;Jl. Sersan Aswan No. 8D, Bekasi";
            $isi .= "</td>";
        $isi .= "</tr>";
    $isi .= "</table>";
    $isi .= "<p> Bahwa berdasarkan Risalah Lelang Nomor: ".$rl_no."/31/2018 tanggal ".$tanggal_rl.", atas permohonan lelang ".$pemohon_lelang." dengan ini menunjuk:</p>";
    $isi .= "<table>";
        $isi .= "<tr>";
            $isi .= "<td>Nama</td>";
            $isi .= "<td>&nbsp;&nbsp;:</td>";
            $isi .= "<td>&nbsp;&nbsp;".$nama_pemenang."</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td valign=\"top\">Alamat</td>";
            $isi .= "<td valign=\"top\">&nbsp;&nbsp;:</td>";
            $isi .= "<td valign=\"top\">&nbsp;&nbsp;".$alamat_pemenang."</td>";
        $isi .= "</tr>";
    $isi .= "</table>";

    $isi .= "<p> Sebagai Pemenang Lelang atas ".$ur_jenis." berupa:</p>";

    $daftar_obyek = LelangObyek::find()
    ->select(['*'])
    ->distinct()
    ->where(['rl_no' => $id_rl])
    ->orderBy(['id'=>SORT_ASC])->all();
    foreach ($daftar_obyek as $daftar_obyek) {
        $obyek_lelang = $daftar_obyek->obyek_lelang;
        $letak_tanah_bangunan = $daftar_obyek->letak_tanah_bangunan;
        $status_tanah_bangunan = $daftar_obyek->status_tanah_bangunan;
        $nama_debitur = $daftar_obyek->nama_debitur;
        $npwp_debitur = $daftar_obyek->npwp_debitur;
        $alamat_debitur = $daftar_obyek->alamat_debitur;
        $luas_tanah = $daftar_obyek->luas_tanah;
        $luas_bangunan = $daftar_obyek->luas_bangunan;
        $nop = $daftar_obyek->nop;
        $kab_kota = $daftar_obyek->kab_kota;
        $id_jenis = $daftar_obyek->id_jenis;
            if ($id_jenis) {
                $daftar_jenis = LelangObyekJenis::find()
                ->select(['*'])
                ->where(['id' => $id_jenis])
                ->one();
                $uraian = $daftar_jenis->uraian;
            }
            else{
                $uraian = '';
            }
        if ($id_jenis == 1) {
            $obyek_lelang = "Sebidang tanah seluas ".$luas_tanah." m2, sesuai ".$status_tanah_bangunan." an. ".$nama_debitur." terletak di ".$letak_tanah_bangunan;
        }
        elseif ($id_jenis == 2) {
            $obyek_lelang = "Sebuah bangunan seluas ".$luas_bangunan." m2, sesuai ".$status_tanah_bangunan." an. ".$nama_debitur." terletak di ".$letak_tanah_bangunan;
        }
        elseif ($id_jenis == 3) {
            $obyek_lelang = "Sebidang tanah berikut bangunan seluas ".$luas_tanah." m2, sesuai ".$status_tanah_bangunan." an. ".$nama_debitur." terletak di ".$letak_tanah_bangunan;
        }
        else{
            $obyek_lelang = $obyek_lelang;
        }

        // $isi .= $obyek_lelang."<br> ";
    // $isi .= "<p> ".$obyek_lelang.". </p>";
    $isi .= "<p> ".$obyek_lelang.". </p>";
    }
    $isi .= "<p> Dengan harga lelang sebesar Rp".number_format($jml_rph_pokok,0,",",".").",- terbilang ".terbilang($jml_rph_pokok, $style=3)." Rupiah. </p>";
    $isi .= "<p> Bertempat di KPKNL Bekasi, Jl. Sersan Aswan No. 8D, Bekasi Timur, Bekasi.</p>";
    #belum lunas

    // $rph_hasil = $jml_rph_pokok+$bl_pembeli+$jml_rph_batal+$jml_rph_wanprestasi;
    // $isi .="Rph hasil = ".$rph_hasil;
    // $isi .="Rph pokok = ".$jml_rph_pokok;
    // $isi .="bl pembeli = ".$bl_pembeli;

    if ($jml_rph_lunas == $rph_kekurangan) {
        # code...
    #sudah lunas
    $isi .= "<p> Harga lelang tersebut telah LUNAS berikut Bea Lelang Pembeli sebesar ".number_format($avg_p_pembeli,2,",",".")."%.</p>";
    }
    else{
    $isi .= 
        "<p> Surat penunjukan ini mengikat dan berlaku selama pemenang lelang memenuhi persyaratan dan kewajiban yang telah ditentukan dalam Risalah Lelang.
        <br> Apabila persyaratan dalam pelaksanaan lelang tersebut tidak dipenuhi maka Surat Penunjukan ini batal demi hukum.</p>";
    }
    
    $isi .= "<p> Demikian Surat Penunjukan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>";
    $isi .= "<table>";
        $isi .= "<tr>";
        	$isi .= "<td>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
            $isi .= "</td>";
        	$isi .= "<td></td>";
    		$isi .= "<td><br>Bekasi, ".$tanggal_sppl."</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
        	$isi .= "<td></td>";
        	$isi .= "<td></td>";
    		$isi .= "<td><b>Pejabat Lelang</b></td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
        	$isi .= "<td></td>";
        	$isi .= "<td></td>";
    		$isi .= "<td><br><br><br><br><b>".$nama_pl."<br>NIP ".$nip_pl."</b></td>";
        $isi .= "</tr>";
    $isi .= "</table>";

$mpdf->WriteHTML($isi);
$mpdf->Output('SPPL'.$rl_no,'I');
exit;
?>