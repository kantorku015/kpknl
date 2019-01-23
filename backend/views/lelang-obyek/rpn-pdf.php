<?php
/* @var $this yii\web\View */
use backend\models\RefTrnKeu;
use backend\models\TrnKeu;
use backend\models\TrnGl;
use backend\models\DaftarAkun;
use backend\models\BukuBesar;
use backend\models\Bulan;
use backend\models\LelangRisalah;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\DatePicker;

require(__DIR__ . '/../../../tools/mpdf60/mpdf.php');
$img = '/../../lelang/tools/kop.jpg';

$mpdf = new mPDF('utf-8', 'A4-P', 11, '', 15, 10);
$mpdf->simpleTables = true;
$mpdf->AliasNbPages('pagetotal');
// $mpdf->SetFooter('{PAGENO} / pagetotal');

$rl_no = $_GET['rl_no'];
#risalah lelang
$data_rl = LelangRisalah::find()
->select(['*'])
->where(['rl_no' => $rl_no])
->one();
$rl_tgl = $data_rl->rl_tgl;


$isi = "";

$isi .= "<table>";
		$isi .= "<tr>";
    		$isi .= "<td colspan=\"3\" align=\"center\"> <img src=\"$img\")> </td>";
        $isi .= "</tr>";
    	$isi .= "<tr>";
    		$isi .= "<td colspan=\"3\" align=\"center\"><b>RINCIAN PENGELUARAN UANG PEMBAYARAN LELANG
    		<br>
    		KEPADA YANG BERHAK</b></td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td colspan=\"3\" align=\"center\">Nomor</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td><br><br>NOMOR RISALAH LELANG</td>";
    		$isi .= "<td><br><br>:</td>";
    		$isi .= "<td><br><br>&nbsp;&nbsp;".$rl_no." / ".$rl_tgl."</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>TANGGAL LELANG</td>";
    		$isi .= "<td>:</td>";
    		$isi .= "<td>&nbsp;&nbsp;_____________________</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>PEJABAT LELANG</td>";
    		$isi .= "<td>:</td>";
    		$isi .= "<td>&nbsp;&nbsp;_____________________</td>";
        $isi .= "</tr>";
$isi .= "</table>";
$isi .= "<table>";
        $isi .= "<tr>";
    		$isi .= "<td><br><br>1. Pokok Lelang</td>";
    		$isi .= "<td><br><br>:</td>";
    		$isi .= "<td align=\"right\"><br><br>Rp_____________________</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>2. Hasil Bersih Lelang Untuk Pemohon Lelang </td>";
    		$isi .= "<td>:</td>";
    		$isi .= "<td align=\"right\">Rp_____________________</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>3. Bea Lelang </td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;a. Bea Lelang Penjual</td>";
    		$isi .= "<td>:</td>";
    		$isi .= "<td align=\"right\">Rp_____________________</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;b. Bea Lelang Pembeli</td>";
    		$isi .= "<td>:</td>";
    		$isi .= "<td align=\"right\">Rp_____________________</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;c. Bea Lelang Batal</td>";
    		$isi .= "<td>:</td>";
    		$isi .= "<td align=\"right\">Rp_____________________</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>4. PPh Final</td>";
    		$isi .= "<td>:</td>";
    		$isi .= "<td align=\"right\">Rp_____________________</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>5. Uang Jaminan Lelang Wanprestasi</td>";
    		$isi .= "<td>:</td>";
    		$isi .= "<td align=\"right\">Rp_____________________</td>";
        $isi .= "</tr>";
		$isi .= "<tr>";
    		$isi .= "<td>Jumlah</td>";
    		$isi .= "<td>:</td>";
    		$isi .= "<td align=\"right\">Rp_____________________</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
    		$isi .= "<td>Terbilang</td>";
    		$isi .= "<td>:</td>";
    		$isi .= "<td>&nbsp;&nbsp;_____________________</td>";
        $isi .= "</tr>";
$isi .= "</table>";
$isi .= "<table>";
        $isi .= "<tr>";
        	$isi .= "<td>
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        	</td>";
        	$isi .= "<td></td>";
    		$isi .= "<td><br><br><br><br><br>Bekasi, __________________</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
        	$isi .= "<td></td>";
        	$isi .= "<td></td>";
    		$isi .= "<td>Pejabat Lelang</td>";
        $isi .= "</tr>";
        $isi .= "<tr>";
        	$isi .= "<td></td>";
        	$isi .= "<td></td>";
    		$isi .= "<td><br><br><br><br>Nama Pejabat Lelang<br>NIP ___________________</td>";
        $isi .= "</tr>";
    $isi .= "</table>";

$mpdf->WriteHTML($isi);
$mpdf->Output('RPN','I');
exit;
?>