<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\LelangRisalah;
use backend\models\LelangPemenang;
use backend\models\LelangPl;
use backend\models\LelangObyek;
use backend\models\LelangObyekJenis;
use backend\models\Bulan;
use backend\models\DaftarObyekRl;

require(__DIR__ . '/../../../tools/mpdf60/mpdf.php');
require(__DIR__ . '/../../../tools/terbilang.php');
// $img = '/../../lelang/tools/kop.jpg';
$img = '/img/suratkop.png';
$size = $_GET['size'];
$tgl_ttd = $_GET['tgl_ttd'];
$jml_rph_pokok_pph = $_GET['jml_rph_pokok_pph'];
$this->title = 'RPN';

// $mpdf = new mPDF('utf-8', 'A4-P', 11, '', 15, 10);
$mpdf = new mPDF('utf-8', 'A4-P', $size, '', 15, 10);
$mpdf->simpleTables = true;
$mpdf->AliasNbPages('pagetotal');
$mpdf->SetFooter('hal. '.'{PAGENO} / pagetotal');

$id_rl = $_GET['id_rl'];
#risalah lelang
$data_rl = LelangRisalah::find()
->select(['*'])
->where(['id' => $id_rl])
->one();
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
$tanggal_sppl = date_format(date_create($sppl_tgl),"d")." ".$bulan_sppl." ".date_format(date_create($sppl_tgl),"Y");


$data_bulan_rl = Bulan::find()
->select(['*'])
->where(['id_bulan'=>date_format(date_create($rl_tgl),"m")])
// ->where(['id_bulan'=>date_format(date_create($tgl_ttd),"m")])
->one();
$data_bulan_ttd = Bulan::find()
->select(['*'])
// ->where(['id_bulan'=>date_format(date_create($rl_tgl),"m")])
->where(['id_bulan'=>date_format(date_create($tgl_ttd),"m")])
->one();
$bulan_rl = $data_bulan_rl->nama;
$bulan_ttd = $data_bulan_ttd->nama;
$tanggal_rl = date_format(date_create($rl_tgl),"d")." ".$bulan_rl." ".date_format(date_create($rl_tgl),"Y");
// $tanggal_rl = date_format(date_create($tgl_ttd),"d")." ".$bulan_rl." ".date_format(date_create($tgl_ttd),"Y");
$tanggal_ttd = date_format(date_create($tgl_ttd),"d")." ".$bulan_ttd." ".date_format(date_create($tgl_ttd),"Y");
$tahun_rl = date_format(date_create($rl_tgl),"Y");


$isi = "";

    $isi .= "<table>";
        $isi .= "<tr>";
            $isi .= "<td align=\"center\"> <img src=\"$img\")> </td>";
        $isi .= "</tr>";
    $isi .= "</table>";
            $isi .= "<p align=\"center\"><b>RINCIAN PENERIMAAN UANG HASIL LELANG</b></p>";
    $isi .= "<table>";
        $isi .= "<tr>";
            $isi .= "<td valign=\"top\">NO/TGL RISALAH  LELANG</td>";
            $isi .= "<td valign=\"top\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
            $data_rl = LelangRisalah::find()
                ->select(['*'])
                ->where(['id' => $id_rl])
                ->one();
                $rl_no = $data_rl->rl_no;
                $data_obyek = LelangObyek::find()
                ->select(['*'])
                ->distinct()
                ->where(['rl_no' => $id_rl])
                ->one();
                    $obyek_lelang = $data_obyek->obyek_lelang;
                    $status_lelang = $data_obyek->status_lelang;
                    if ($status_lelang == 3) {
                        // $isi .= "<td><br>&nbsp;&nbsp; Lelang Batal, No CN-".$jurnal_rek."</td>";
                        $isi .= "<td valign=\"top\">Lelang Batal RL- tgl. ".$tanggal_rl."</td>";
                    }
                    else{
                        // $isi .= "<td><br>&nbsp;&nbsp;".$rl_no."/31/2018 </td>";
                        $isi .= "<td valign=\"top\">".$rl_no."/31/".$tahun_rl." tgl. ".$tanggal_rl."</td>";
                    }
        $isi .= "</tr>";
    $isi .= "</table>";
    
    $isi .= "<table>";
        $isi .= "<tr>";
            $isi .= "<td valign=\"top\">PEMOHON LELANG</td>";
        $isi .= "<td valign=\"top\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
            $isi .= "<td valign=\"top\">";
            $daftar_obyek = LelangObyek::find()
                ->select(['*'])
                // ->distinct()
                ->where(['rl_no' => $id_rl])
                // ->andWhere(['tahun'=>$tahun_rl])
                ->orderBy(['id'=>SORT_ASC])->all();
                foreach ($daftar_obyek as $daftar_obyek) {
                    $id_obyek = $daftar_obyek->id;
                        $data_obyek = LelangObyek::find()
                        ->select(['*'])
                        ->distinct()
                        ->where(['id' => $id_obyek])
                        ->one();
                        $obyek_lelang = $data_obyek->obyek_lelang;
                // foreach ($daftar_obyek as $daftar_obyek) {
                        $pemohon_lelang = $data_obyek->pemohon_lelang;
                    $isi .= $pemohon_lelang;
                }
            $isi .= "</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td valign=\"top\">PEMBELI LELANG</td>";
        $isi .= "<td valign=\"top\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
             if ($status_lelang == 3) {
                $isi .= "<td valign=\"top\"> - </td>";
             }
             else{
                $isi .= "<td valign=\"top\">";

                $hitung_daftar_obyek = LelangObyek::find()
                    ->select(['id_pemenang'])
                    ->distinct()
                    ->where(['rl_no' => $id_rl])
                    ->orderBy(['id'=>SORT_ASC])->count();

                $no_obyek = 1;
                $daftar_obyek = LelangObyek::find()
                ->select(['*'])
                ->where(['rl_no' => $id_rl])
                // ->andWhere(['tahun'=>$tahun_rl])
                ->orderBy(['id'=>SORT_ASC])->all();
                foreach ($daftar_obyek as $daftar_obyek) {
                    $id_obyek = $daftar_obyek->id;
                        // $data_obyek = LelangObyek::find()
                        // ->select(['*'])
                        // ->distinct()
                        // ->where(['id' => $id_obyek])
                        // ->one();
                    $id_pemenang = $data_obyek->id_pemenang;
                            #data pemenang
                        $data_pemenang = LelangPemenang::find()
                        ->select(['*'])
                        ->where(['id'=>$id_pemenang])
                        ->one();
                        $nama_pemenang = $data_pemenang->nama_pemenang;
                        // if ($no_obyek <> 1) {
                        //     # code...
                            if ($no_obyek = $hitung_daftar_obyek) {
                                # code...
                                $isi .= $nama_pemenang.". ";
                            }
                            else{
                                $isi .= $nama_pemenang.", ";
                            }
                        // }
                        // else{
                        //     $isi .= $nama_pemenang;
                        // }
                        $no_obyek++;
                    }
                $isi .= "</td>";
             }
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td valign=\"top\">KETERANGAN</td>";
        $isi .= "<td valign=\"top\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>";
            // $isi .= "<td valign=\"top\">".'$obyek_lelang'."</td>";

            $isi .= "<td valign=\"top\">";
            $daftar_obyek = LelangObyek::find()
                ->select(['*'])
                ->where(['rl_no' => $id_rl])
                // ->andWhere(['tahun'=>$tahun_rl])
                ->orderBy(['id'=>SORT_ASC])->all();
                foreach ($daftar_obyek as $daftar_obyek) {
                    $id_obyek = $daftar_obyek->id;
                        // $data_obyek = LelangObyek::find()
                        // ->select(['*'])
                        // ->distinct()
                        // ->where(['id' => $id_obyek])
                        // ->one();
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

                    $isi .= $obyek_lelang."<br> ";
                }
            $isi .= "</td>";

        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td colspan=\"3\">";
            $isi .= "</td>";
        $isi .= "</tr>";
    $isi .= "</table>";
    
    $isi .= "<hr>";



    // $isi .= "<table>";
    //     $isi .= "<tr>";
    //         $isi .= "<td colspan=\"3\"><hr>";
    //         $isi .= "</td>";
    //     $isi .= "</tr>";

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
        // ->distinct()
        ->where(['rl_no' => $id_rl])
        // ->andWhere(['tahun'=>$tahun_rl])
        ->orderBy(['id'=>SORT_ASC])->all();
        foreach ($daftar_obyek as $daftar_obyek) {
            $id_obyek = $daftar_obyek->id;
                // $data_obyek = LelangObyek::find()
                // ->select(['*'])
                // ->distinct()
                // ->where(['id' => $id_obyek])
                // ->one();
                $obyek_lelang = $daftar_obyek->obyek_lelang;
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

    $data_batas_lunas = LelangObyek::find()
    ->select(['batas_lunas'])
    ->where(['rl_no'=>$rl_no])
    ->one();
    $batas_lunas = $data_batas_lunas->batas_lunas;
    $data_bulan_lunas = Bulan::find()
        ->select(['*'])
        ->where(['id_bulan'=>date_format(date_create($batas_lunas),"m")])
        ->one();
        $bulan_lunas = $data_bulan_lunas->nama;
    $tanggal_batas_lunas = date_format(date_create($batas_lunas),"d")." ".$bulan_lunas." ".date_format(date_create($batas_lunas),"Y");

    $isi .= "<table>";
        $isi .= "<tr>";
    		$isi .= "<td>1.</td>";
            $isi .= "<td>Harga Pokok Lelang</td>";
            $isi .= "<td></td>";
            $isi .= "<td align=\"right\">&nbsp;&nbsp;<b>Rp".number_format($total_rph_pokok,0,",",".").",-</b></td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td></td>";
            $isi .= "<td>Harga Bersih Lelang</td>";
            $isi .= "<td align=\"right\">&nbsp;&nbsp;Rp".number_format($total_rph_bersih,0,",",".").",-</td>";
            $isi .= "<td></td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td></td>";
            $isi .= "<td>Bea Lelang Penjual (".number_format($avg_p_penjual,2,",",".")."%)</td>";
            $isi .= "<td align=\"right\">&nbsp;&nbsp;Rp".number_format($total_rph_bl_penjual,0,",",".").",-</td>";
            $isi .= "<td></td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td></td>";
            $isi .= "<td>PPh Final (".number_format($avg_p_pph,2,",",".")."%)</td>";
            $isi .= "<td align=\"right\">&nbsp;&nbsp;Rp".number_format($total_rph_pph,0,",",".").",-</td>";
            $isi .= "<td></td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td>2.</td>";
            $isi .= "<td>Bea Lelang Pembeli (".number_format($avg_p_pembeli,2,",",".")."%)</td>";
            $isi .= "<td></td>";
            $isi .= "<td align=\"right\">&nbsp;&nbsp;Rp".number_format($total_rph_bl_pembeli,0,",",".").",-</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td>3.</td>";
            $isi .= "<td>Bea Lelang Batal</td>";
            $isi .= "<td></td>";
            $isi .= "<td align=\"right\">&nbsp;&nbsp;Rp".number_format($total_rph_batal,0,",",".").",-</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td>4.</td>";
            $isi .= "<td>Uang Jaminan Lelang Wanprestasi</td>";
            $isi .= "<td></td>";
            $isi .= "<td align=\"right\">&nbsp;&nbsp;Rp".number_format($total_rph_wanprestasi,0,",",".").",-</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
            $isi .= "<td></td>";
            $isi .= "<td></td>";
    		$isi .= "<td align=\"right\"><b>Jumlah:</b></td>";
    		$isi .= "<td>&nbsp;&nbsp;<b>Rp".number_format($total_rph_hasil,0,",",".").",-</b></td>";
        $isi .= "</tr>";
    $isi .= "</table>";
    $isi .= "<table>";
        $isi .= "<tr>";
        	$isi .= "<td>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   ";
            $isi .= "</td>";
        	$isi .= "<td></td>";
    		$isi .= "<td><br><br>Bekasi, ".$tanggal_ttd."</td>";
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
$isi .= "<br>";
$isi .= "Catatan:";
$isi .= "<br>";
$isi .= "- Uang Jaminan Penawaran Lelang";
$isi .= " sebesar Rp".number_format($total_rph_jaminan,0,",",".")."<br>";
if ($status_lelang <> 3) {
    $isi .= "- Kekurangan Pelunasan Lelang ";
    $isi .= "sebesar Rp".number_format($total_kekurangan,0,",",".")."";
    // $isi .= "- Batas Pelunasan Lelang tanggal ".$tanggal_batas_lunas;
    // $isi .= "- Batas Pelunasan Lelang tanggal ".$rl_no;
}

$mpdf->WriteHTML($isi);
$mpdf->Output('RPN'.$rl_no,'I');
exit;
?>