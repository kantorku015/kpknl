<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LelangObyek */

$this->title = 'Rincian Penerimaan Uang Hasil Lelang';
$this->params['breadcrumbs'][] = ['label' => 'Lelang Obyeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$img = '/../../lelang/tools/kop.jpg';
?>
<div class="lelang-obyek-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <table>
    	<tr>
			<td colspan=\"3\" align=\"center\"> <img src="<?=$img?>"></td>
        </tr>
    	<tr>
    		<td colspan="3" align="center"><b>RINCIAN PENERIMAAN UANG PEMBAYARAN LELANG</b></td>
        </tr>
        <tr>
    		<td colspan="3" align="center">Nomor</td>
        </tr>
        <tr>
    		<td><br><br>NOMOR RISALAH LELANG</td>
    		<td><br><br>:</td>
    		<td><br><br>&nbsp;&nbsp;_____________________</td>
        </tr>
        <tr>
    		<td>TANGGAL LELANG</td>
    		<td>:</td>
    		<td>&nbsp;&nbsp;_____________________</td>
        </tr>
        <tr>
    		<td>PEJABAT LELANG</td>
    		<td>:</td>
    		<td>&nbsp;&nbsp;_____________________</td>
        </tr>
        <tr>
    		<td><br><br>1. Pokok Lelang</td>
    		<td><br><br>:</td>
    		<td><br><br>&nbsp;&nbsp;Rp_____________________</td>
        </tr>
        <tr>
    		<td>2. Hasil Bersih Lelang Untuk Pemohon Lelang </td>
    		<td>:</td>
    		<td>&nbsp;&nbsp;Rp_____________________</td>
        </tr>
        <tr>
    		<td>3. Bea Lelang </td>
        </tr>
        <tr>
    		<td>&nbsp;&nbsp;&nbsp;&nbsp;a. Bea Lelang Penjual</td>
    		<td>:</td>
    		<td>&nbsp;&nbsp;Rp_____________________</td>
        </tr>
        <tr>
    		<td>&nbsp;&nbsp;&nbsp;&nbsp;b. Bea Lelang Pembeli</td>
    		<td>:</td>
    		<td>&nbsp;&nbsp;Rp_____________________</td>
        </tr>
        <tr>
    		<td>&nbsp;&nbsp;&nbsp;&nbsp;c. Bea Lelang Batal</td>
    		<td>:</td>
    		<td>&nbsp;&nbsp;Rp_____________________</td>
        </tr>
        <tr>
    		<td>4. PPh Final</td>
    		<td>:</td>
    		<td>&nbsp;&nbsp;Rp_____________________</td>
        </tr>
        <tr>
    		<td>5. Uang Jaminan Lelang Wanprestasi</td>
    		<td>:</td>
    		<td>&nbsp;&nbsp;Rp_____________________</td>
        </tr>
        <tr>
    		<td>Jumlah</td>
    		<td>:</td>
    		<td>&nbsp;&nbsp;Rp_____________________</td>
        </tr>
        <tr>
    		<td>Terbilang</td>
    		<td>:</td>
    		<td>&nbsp;&nbsp;_____________________</td>
        </tr>
        <tr>
        	<td></td>
        	<td></td>
    		<td><br><br><br><br><br>Bekasi, __________________</td>
        </tr>
        <tr>
        	<td></td>
        	<td></td>
    		<td>Pejabat Lelang</td>
        </tr>
        <tr>
        	<td></td>
        	<td></td>
    		<td><br><br><br><br>Nama Pejabat Lelang<br>NIP ___________________</td>
        </tr>
    </table>

</div>
