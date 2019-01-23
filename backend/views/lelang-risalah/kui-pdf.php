<?php

use yii\helpers\Html;
use yii\helpers\Url;

use backend\models\LelangRisalah;
use backend\models\LelangPemenang;
use backend\models\LelangPl;
use backend\models\LelangJenis;
use backend\models\LelangObyek;
use backend\models\Bulan;
use backend\models\LelangTtd;
use backend\models\LelangObyekJenis;
use backend\models\DaftarObyekRl;
require(__DIR__ . '/../../../tools/mpdf60/mpdf.php');
require(__DIR__ . '/../../../tools/terbilang.php');
// $img = '/../../lelang/tools/kop.jpg';
$img = '/img/suratkop.png';
$id_obyek = $_GET['id_obyek'];
// $id_rl = $_GET['id_rl'];
$size = $_GET['size'];

// $mpdf = new mPDF('utf-8', 'A4-P', 10, '', 15, 10);
$mpdf = new mPDF('utf-8', 'A4-P', $size, '', 15, 10);
$mpdf->simpleTables = true;
$mpdf->AliasNbPages('pagetotal');
// $mpdf->SetFooter('{PAGENO} / pagetotal');

#obyek lelang
$data_obyek = LelangObyek::find()
->select(['*'])
->where(['id' => $id_obyek])
->one();
$id_rl = $data_obyek->rl_no;
$id_obyek = $data_obyek->id;
$obyek_lelang = $data_obyek->obyek_lelang;
$letak_tanah_bangunan = $data_obyek->letak_tanah_bangunan;
$status_tanah_bangunan = $data_obyek->status_tanah_bangunan;
$nama_debitur = $data_obyek->nama_debitur;
$npwp_debitur = $data_obyek->npwp_debitur;
$alamat_debitur = $data_obyek->alamat_debitur;
$luas_tanah = $data_obyek->luas_tanah;
$luas_bangunan = $data_obyek->luas_bangunan;
$nop = $data_obyek->nop;
$kab_kota = $data_obyek->kab_kota;
$id_jenis = $data_obyek->id_jenis;



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
$kuitansi_no = $data_obyek->kuitansi_no;

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

$tgl_jurnal = $data_obyek->tgl_jurnal;
$data_bulan_jurnal = Bulan::find()
->select(['*'])
->where(['id_bulan'=>date_format(date_create($tgl_jurnal),"m")])
->one();
$bulan_jurnal = $data_bulan_jurnal->nama;
$tanggal_jurnal = date_format(date_create($tgl_jurnal),"d")." ".$bulan_jurnal." ".date_format(date_create($tgl_jurnal),"Y");

$tgl_setor_pnbp = $data_obyek->tgl_setor_pnbp;
$data_bulan_pnbp = Bulan::find()
->select(['*'])
->where(['id_bulan'=>date_format(date_create($tgl_setor_pnbp),"m")])
->one();
$bulan_pnbp = $data_bulan_pnbp->nama;
$tanggal_pnbp = date_format(date_create($tgl_setor_pnbp),"d")." ".$bulan_pnbp." ".date_format(date_create($tgl_setor_pnbp),"Y");

$tgl_setor_hbl = $data_obyek->tgl_setor_hbl;
$data_bulan_hbl = Bulan::find()
->select(['*'])
->where(['id_bulan'=>date_format(date_create($tgl_setor_hbl),"m")])
->one();
$bulan_hbl = $data_bulan_hbl->nama;
$tanggal_hbl = date_format(date_create($tgl_setor_hbl),"d")." ".$bulan_hbl." ".date_format(date_create($tgl_setor_hbl),"Y");


//data rl
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
$tahun_rl = date_format(date_create($rl_tgl),"Y");



 


#penandatangan
#atasan
$data_atasan = LelangTtd::find()
->select(['*'])
->where(['status'=>'atasan'])
->one();
$nama_atasan = $data_atasan->nama;
$nip_atasan = $data_atasan->nip;
$jabatan_atasan = $data_atasan->jabatan;

#bendahara
#atasan
$data_bendahara = LelangTtd::find()
->select(['*'])
->where(['status'=>'bendahara'])
->one();
$nama_bendahara = $data_bendahara->nama;
$nip_bendahara = $data_bendahara->nip;
$jabatan_bendahara = $data_bendahara->jabatan;

$isi = "";

    $isi .= "<table>";
        $isi .= "<tr>";
            $isi .= "<td align=\"center\"> <img src=\"$img\")> </td>";
        $isi .= "</tr>";
    $isi .= "</table>";
            $isi .= "<h2 align=\"center\"><b>K U I T A N S I</b></h2>";
            $isi .= "<p align=\"center\"><b>Nomor: KUI - ".$kuitansi_no."/WKN.08/KNL.02/".$tahun_rl."</b></p>";
            $isi .= "<br>RISALAH LELANG NOMOR ".$rl_no."/31/".$tahun_rl." TANGGAL ".$tanggal_rl;
    $isi .= "<hr>";
    $isi .= "<table>";
        $isi .= "<tr>";
            $isi .= "<td valign=\"top\">TELAH TERIMA DARI</td>";
            $isi .= "<td valign=\"top\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
            $isi .= "<td valign=\"top\">".$nama_pemenang."</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td></td>";
            $isi .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
            $isi .= "<td>Beralamat di ".$alamat_pemenang."</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td valign=\"top\">UANG SEJUMLAH</td>";
            $isi .= "<td valign=\"top\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
            $isi .= "<td valign=\"top\"><b>#".terbilang($rph_hasil,$style=3)." Rupiah#</b></td>";
        $isi .= "</tr>";
    $isi .= "</table>";
    // $isi .= "<br>";
    $isi .= "<p><b>KETERANGAN:</b><br>";
    $isi .= "Untuk pembayaran hasil bersih lelang atas permintaan  ".$pemohon_lelang." tanggal ".$tanggal_rl.", Pejabat Lelang ".$nama_pl." NIP ".$nip_pl.", Risalah Lelang Nomor ".$rl_no."/31/".$tahun_rl." tanggal ".$tanggal_rl." atas pembelian:</p>";
    

    // $daftar_obyek = LelangObyek::find()
    // ->select(['*'])
    // ->where(['id' => $id_obyek])
    // ->orderBy(['id'=>SORT_ASC])->all();
    // foreach ($daftar_obyek as $daftar_obyek) {
    //     $id_obyek = $daftar_obyek->id;
    //     $obyek_lelang = $daftar_obyek->obyek_lelang;
    //     $letak_tanah_bangunan = $daftar_obyek->letak_tanah_bangunan;
    //     $status_tanah_bangunan = $daftar_obyek->status_tanah_bangunan;
    //     $nama_debitur = $daftar_obyek->nama_debitur;
    //     $npwp_debitur = $daftar_obyek->npwp_debitur;
    //     $alamat_debitur = $daftar_obyek->alamat_debitur;
    //     $luas_tanah = $daftar_obyek->luas_tanah;
    //     $luas_bangunan = $daftar_obyek->luas_bangunan;
    //     $nop = $daftar_obyek->nop;
    //     $kab_kota = $daftar_obyek->kab_kota;
    //     $id_jenis = $daftar_obyek->id_jenis;
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
    $isi .= "<p> ".$obyek_lelang.". </p>";
    // }
    


    
    $isi .= "<b>RINCIAN:</b>";
    $isi .= "<table>";
    $isi .= "<tr>";
        $isi .= "<td>";
        $isi .= "Pokok Lelang";
        $isi .= "</td>";
        $isi .= "<td>";
        $isi .= ":&nbsp;&nbsp;Rp";
        $isi .= "</td>";
        $isi .= "<td align=\"right\">";
        $isi .= number_format($jml_rph_pokok,0,",",".").",-";
        $isi .= "</td>";
    $isi .= "</tr>";
    $isi .= "<tr>";
        $isi .= "<td valign=\"top\">";
        $isi .= "Bea Lelang Pembeli";
        $isi .= "</td>";
        $isi .= "<td valign=\"top\">";
        $isi .= ":&nbsp;&nbsp;Rp";
        $isi .= "</td>";
        $isi .= "<td align=\"right\" valign=\"top\">";
        $isi .= number_format($bl_pembeli,0,",",".").",-";
        $isi .= "</td>";
        // $isi .= "<hr></td>";
    $isi .= "</tr>";
    // // batal
    // $isi .= "<tr>";
    //     $isi .= "<td valign=\"top\">";
    //     $isi .= "Bea Pencacahan";
    //     $isi .= "</td>";
    //     $isi .= "<td valign=\"top\">";
    //     $isi .= ":&nbsp;&nbsp;Rp";
    //     $isi .= "</td>";
    //     $isi .= "<td align=\"right\" valign=\"top\">";
    //     $isi .= number_format($jml_rph_batal,0,",",".").",-";
    //     $isi .= "</td>";
    //     // $isi .= "<hr></td>";
    // $isi .= "</tr>";
    // // wan
    // $isi .= "<tr>";
    //     $isi .= "<td valign=\"top\">";
    //     $isi .= "Jasa Pra Lelang";
    //     $isi .= "</td>";
    //     $isi .= "<td valign=\"top\">";
    //     $isi .= ":&nbsp;&nbsp;Rp";
    //     $isi .= "</td>";
    //     $isi .= "<td align=\"right\" valign=\"top\">";
    //     $isi .= number_format($jml_rph_wanprestasi,0,",",".").",-";
    //     $isi .= "</td>";
    //     // $isi .= "<hr></td>";
    // $isi .= "</tr>";
    $isi .= "<tr>";
        $isi .= "<td>";
        $isi .= "Jumlah";
        $isi .= "</td>";
        $isi .= "<td>";
        $isi .= ":&nbsp;&nbsp;<b>Rp</b>";
        $isi .= "</td>";
        $isi .= "<td align=\"right\">";
        $isi .= "<b>".number_format($bl_pembeli+$jml_rph_pokok+$jml_rph_batal+$jml_rph_wanprestasi,0,",",".").",-</b>";
        $isi .= "</td>";
    $isi .= "</tr>";
    $isi .= "</table>";
    $isi .= "<br>";

    $isi .= "<table>";
        // $isi .= "<tr>";
        //     $isi .= "<td>
        //     <b>Mengetahui </b>";
        //     $isi .= "</td>";
        //     $isi .= "<td></td>";
        //     $isi .= "<td>
        //     <b>Bekasi, ".$tanggal_hbl."</td>";
        // $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td><b>Mengetahui<br>".$jabatan_atasan."</b></td>";
            $isi .= "<td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
            $isi .= "<td><b>Bekasi, ".$tanggal_jurnal."<br>Bendahara Penerimaan</b></td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            // $isi .= "<td><b><br><br><br><br><br><br>".$nama_atasan."<br>NIP ".$nip_atasan."</b></td>";
            $isi .= "<td><b><br><br><br><br><br><br>".$nama_atasan."<br>NIP ".$nip_atasan."</b></td>";
            $isi .= "<td></td>";
            // $isi .= "<td><b><br><br><br><br><br><br>".$nama_bendahara."<br>NIP ".$nip_bendahara."</b></td>";
            $isi .= "<td><b><br><br><br><br><br><br>".$nama_bendahara."<br>NIP ".$nip_bendahara."</b></td>";
        $isi .= "</tr>";
    $isi .= "</table>";


$mpdf->WriteHTML($isi);
$mpdf->Output('KUI'.$rl_no,'I');
exit;
?>