<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\LelangRisalah;
use backend\models\LelangPemenang;
use backend\models\LelangPl;
use backend\models\LelangJenis;
use backend\models\LelangObyek;
use backend\models\Bulan;
use backend\models\LelangTtd;

require(__DIR__ . '/../../../tools/mpdf60/mpdf.php');
require(__DIR__ . '/../../../tools/terbilang.php');
// $img = '/../../lelang/tools/kop.jpg';
$img = '/img/suratkop.png';


$mpdf = new mPDF('utf-8', 'A4-P', 11, '', 15, 10);
$mpdf->simpleTables = true;
$mpdf->AliasNbPages('pagetotal');
// $mpdf->SetFooter('{PAGENO} / pagetotal');

$id_rl = $_GET['id_rl'];
$jml_rph_pokok_pph = $_GET['jml_rph_pokok_pph'];
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
$tahun_rl = date_format(date_create($rl_tgl),"Y");


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
    $status_lelang = $data_obyek->status_lelang;

     $daftar_kuitansi = LelangObyek::find()
        ->select(['*'])
        ->where(['rl_no' => $id_rl])
            ->andWhere(['not', ['kuitansi_no' => null]])
            ->andWhere(['not', ['kuitansi_no' => '']])
        ->orderBy(['id'=>SORT_ASC])->all();
        foreach ($daftar_kuitansi as $daftar_kuitansi) {
        $kuitansi_no = $daftar_kuitansi->kuitansi_no;
    }
    

    $array_rph_pokok = array();
        $array_rph_jaminan = array();
        $array_rph_bersih = array();
        $array_rph_bl_penjual = array();
        $array_rph_bl_pembeli = array();
        $array_rph_pph = array();
        $array_rph_batal = array();
        $array_rph_wanprestasi = array();
        $array_rph_hasil = array();
        $array_selisih = array();
        $array_kekurangan = array();

        $daftar_obyek = LelangObyek::find()
        ->select(['*'])
        ->where(['rl_no' => $id_rl])
        ->orderBy(['id'=>SORT_ASC])->all();
        foreach ($daftar_obyek as $daftar_obyek) {
            $pemohon_lelang = $daftar_obyek->pemohon_lelang;
            $status_lelang = $daftar_obyek->status_lelang;
            $id_pemenang  = $daftar_obyek->id_pemenang;
                #data pemenang
                $data_pemenang = LelangPemenang::find()
                ->select(['*'])
                ->where(['id'=>$id_pemenang])
                ->one();
                $nama_pemenang = $data_pemenang->nama_pemenang;
            $obyek_lelang = $daftar_obyek->obyek_lelang;
            $id_obyek = $daftar_obyek->id;
            $persen_pembeli = $daftar_obyek->persen_pembeli;

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
            // $bl_pembeli = ceil($persen_pembeli/100*$jml_rph_pokok);

            // $pph = ceil($avg_p_pph/100*$jml_rph_pokok);
            $pph = ceil($avg_p_pph/100*$jml_rph_pokok_pph);

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


            // $isi .= "<tr>";
            //     $isi .= "<td valign=\"top\">PEMOHON LELANG</td>";
            // $isi .= "<td valign=\"top\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
            //     $isi .= "<td valign=\"top\">".$pemohon_lelang."</td>";
            // $isi .= "</tr>";
            // $isi .= "<tr>";
            //     $isi .= "<td valign=\"top\">PEMBELI LELANG</td>";
            // $isi .= "<td valign=\"top\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
            //      if ($status_lelang == 3) {
            //         $isi .= "<td valign=\"top\"> - </td>";
            //      }
            //      else{
            //         $isi .= "<td valign=\"top\">".$nama_pemenang."</td>";
            //      }
            // $isi .= "</tr>";
            // $isi .= "<tr>";
            //     $isi .= "<td valign=\"top\">KETERANGAN</td>";
            // $isi .= "<td valign=\"top\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
            //     $isi .= "<td valign=\"top\">".$obyek_lelang."</td>";
            // $isi .= "</tr>";
            // $isi .= "<tr>";
            //     $isi .= "<td colspan=\"3\"><hr>";
            //     $isi .= "</td>";
            // $isi .= "</tr>";

            array_push($array_rph_pokok, $jml_rph_pokok);
            array_push($array_rph_jaminan, $jml_rph_jaminan);
            array_push($array_rph_bersih, $rph_bersih);
            array_push($array_rph_bl_penjual, $bl_penjual);
            array_push($array_rph_bl_pembeli, $bl_pembeli);
            array_push($array_rph_pph, $pph);
            array_push($array_rph_batal, $jml_rph_batal);
            array_push($array_rph_wanprestasi, $jml_rph_wanprestasi);
            array_push($array_rph_hasil, $rph_hasil);
            array_push($array_selisih, $selisih);
            array_push($array_kekurangan, $rph_kekurangan);

        }
    // $isi .= "</table>";
            $total_rph_pokok = array_sum($array_rph_pokok);
            $total_rph_jaminan = array_sum($array_rph_jaminan);
            $total_rph_bersih = array_sum($array_rph_bersih);
            $total_rph_bl_penjual = array_sum($array_rph_bl_penjual);
            $total_rph_bl_pembeli = array_sum($array_rph_bl_pembeli);
            $total_rph_pph = array_sum($array_rph_pph);
            $total_rph_batal = array_sum($array_rph_batal);
            $total_rph_wanprestasi = array_sum($array_rph_wanprestasi);
            $total_rph_hasil = array_sum($array_rph_hasil);
            $total_selisih = array_sum($array_selisih);
            $total_kekurangan = array_sum($array_kekurangan);



$tgl_jurnal = $data_obyek->tgl_jurnal;
$jurnal_rek = $data_obyek->jurnal_rek;
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
            $isi .= "<td colspan=\"3\" align=\"center\"> <img src=\"$img\")> </td>";
        $isi .= "</tr>";
$isi .= "</table>";
            $isi .= "<p align=\"center\"><b>RINCIAN PENGELUARAN UANG PEMBAYARAN LELANG
            <br>
            KEPADA YANG BERHAK</b>";
    		$isi .= "<br> Nomor: ".$kuitansi_no."/WKN.08/KNL.0206/".$tahun_rl."</p>";
$isi .= "<table>";
        $isi .= "<tr>";
    		$isi .= "<td><br>NOMOR RISALAH LELANG</td>";
            $isi .= "<td><br>:</td>";
            if ($status_lelang == 3) {
    		  $isi .= "<td><br>&nbsp;&nbsp; Lelang Batal, No CN-".$jurnal_rek."</td>";
            }
            else{
                $isi .= "<td><br>&nbsp;&nbsp;".$rl_no."/31/".$tahun_rl." </td>";
            }
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>TANGGAL LELANG</td>";
    		$isi .= "<td>:</td>";
            if ($status_lelang == 3) {
    		  $isi .= "<td>&nbsp;&nbsp; Tgl CN ".$tanggal_jurnal."</td>";
            }
            else{
                $isi .= "<td>&nbsp;&nbsp;".$tanggal_rl."</td>";
            }
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>PEJABAT LELANG</td>";
    		$isi .= "<td>:</td>";
    		$isi .= "<td>&nbsp;&nbsp;".$nama_pl."/NIP ".$nip_pl."</td>";
        $isi .= "</tr>";
$isi .= "</table>";
$isi .= "<table>";
        $isi .= "<tr>";
    		$isi .= "<td><br><br>1. Pokok Lelang</td>";
    		$isi .= "<td><br><br>:</td>";
    		$isi .= "<td align=\"right\"><br><br>Rp".number_format($total_rph_pokok,0,",",".").",-</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>2. Hasil Bersih Lelang Untuk Pemohon Lelang </td>";
    		$isi .= "<td>:</td>";
    		$isi .= "<td align=\"right\">Rp".number_format($total_rph_bersih,0,",",".").",-</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>3. Bea Lelang </td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;a. Bea Lelang Penjual</td>";
    		$isi .= "<td>:</td>";
            if ($total_rph_bl_penjual<>0) {
    		  $isi .= "<td align=\"right\">Rp".number_format($total_rph_bl_penjual,0,",",".").",-</td>";
            }
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;b. Bea Lelang Pembeli</td>";
    		$isi .= "<td>:</td>";
    		if ($total_rph_bl_pembeli<>0) {
              $isi .= "<td align=\"right\">Rp".number_format($total_rph_bl_pembeli,0,",",".").",-</td>";
            }
            // $isi .= "<td align=\"right\">Rp".number_format($bl_pembeli,0,",",".")."</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;c. Bea Lelang Batal</td>";
    		// $isi .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;c. Bea Pencacahan</td>";
    		$isi .= "<td>:</td>";
            if ($jml_rph_batal<>0) {
              $isi .= "<td align=\"right\">Rp".number_format($total_rph_batal,0,",",".").",-</td>";
            }
    		// $isi .= "<td align=\"right\">Rp".number_format($jml_rph_batal,0,",",".")."</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>4. PPh Final</td>";
    		$isi .= "<td>:</td>";
            if ($pph<>0) {
              $isi .= "<td align=\"right\">Rp".number_format($total_rph_pph,0,",",".").",-</td>";
            }
    		// $isi .= "<td align=\"right\">Rp".number_format($pph,0,",",".")."</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td>5. Uang Jaminan Lelang Wanprestasi</td>";
    		// $isi .= "<td>5. Jasa Pra Lelang</td>";
    		$isi .= "<td>:</td>";
            if ($jml_rph_wanprestasi<>0) {
              $isi .= "<td align=\"right\">Rp".number_format($total_rph_wanprestasi,0,",",".").",-</td>";
            }
    		// $isi .= "<td align=\"right\">Rp".$jml_rph_wanprestasi."</td>";
        $isi .= "</tr>";
		$isi .= "<tr>";
    		$isi .= "<td ><b>Jumlah</b></td>";
    		$isi .= "<td ><b>:</b></td>";
    		$isi .= "<td align=\"right\"><b>Rp".number_format($total_rph_hasil,0,",",".").",-</b></td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td valign=\"top\">Terbilang</td>";
    		$isi .= "<td valign=\"top\">:</td>";
    		$isi .= "<td valign=\"top\">".terbilang($total_rph_hasil,$style=3)." Rupiah</td>";
        $isi .= "</tr>";
$isi .= "</table>";
$isi .= "<br>";
$isi .= "<br>";
$isi .= "<table>";
        $isi .= "<tr>";
            $isi .= "<td>
            Mengetahui ";
            $isi .= "</td>";
            $isi .= "<td></td>";
            $isi .= "<td>
            Bekasi, ".$tanggal_pnbp."</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td>".$jabatan_atasan."</td>";
            $isi .= "<td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
            $isi .= "<td>Bendahara Penerimaan</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td><br><br><br><br>".$nama_atasan."<br>NIP ".$nip_atasan."</td>";
            $isi .= "<td></td>";
            $isi .= "<td><br><br><br><br>".$nama_bendahara."<br>NIP ".$nip_bendahara."</td>";
        $isi .= "</tr>";
    $isi .= "</table>";

$mpdf->WriteHTML($isi);
$mpdf->Output('RPL'.$rl_no,'I');
exit;
?>