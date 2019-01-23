<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LelangObyek */

$this->title = 'Rincian Penerimaan Uang Hasil Lelang';
$this->params['breadcrumbs'][] = ['label' => 'Lelang Obyeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// $img = '/../../lelang/tools/kop.jpg';
$img = '/img/suratkop.png';
?>
<div class="lelang-obyek-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <table>
        <tr>
            <td align=\"center\"> <a href="<?=$img?>"><img src="<?=$img?>"></a></td>
        </tr>
    </table>
    <table>
    	<tr>
    		<td colspan="3" align="center"><b>RINCIAN PENERIMAAN UANG HASIL LELANG</b></td>
        </tr>
        <tr>
            <td>NO/TGL RISALAH LELANG</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;_________________________________________</td>
        </tr>
        <tr>
            <td>PEMOHON LELANG</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;_________________________________________</td>
        </tr>
        <tr>
            <td>PEMBELI LELANG</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;_________________________________________</td>
        </tr>
        <tr>
            <td>KETERANGAN</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;_________________________________________</td>
        </tr>
    </table>
<HR>
    <table>
        <tr>
    		<td>1.</td>
            <td>Harga Pokok Lelang</td>
            <td></td>
            <td>&nbsp;&nbsp;<b>Rp_____________________</b></td>
        </tr>
        <tr>
            <td></td>
            <td>Harga Bersih Lelang</td>
            <td>&nbsp;&nbsp;Rp_____________________</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>Bea Lelang Penjual (...%)</td>
            <td>&nbsp;&nbsp;Rp_____________________</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>PPh Final (...%)</td>
            <td>&nbsp;&nbsp;Rp_____________________</td>
            <td></td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Bea Lelang Pembeli (...%)</td>
            <td></td>
            <td>&nbsp;&nbsp;Rp_____________________</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Bea Lelang Batal</td>
            <td></td>
            <td>&nbsp;&nbsp;Rp_____________________</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
    		<td align="right"><b>Jumlah:</b></td>
    		<td>&nbsp;&nbsp;<b>Rp_____________________</b></td>
        </tr>
    </table>
    <table>
        <tr>
        	<td>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
            </td>
        	<td></td>
    		<td><br><br><br><br><br>Bekasi, __________________</td>
        </tr>
        <tr>
        	<td></td>
        	<td></td>
    		<td><b>Pejabat Lelang</b></td>
        </tr>
        <tr>
        	<td></td>
        	<td></td>
    		<td><br><br><br><br><b>Nama Pejabat Lelang<br>NIP ___________________</b></td>
        </tr>
    </table>
<br>
Catatan:
<br>
- Uang Jaminan Penawaran Lelang<br>
&nbsp;&nbsp;sebesar Rp_________________<br>
- Kekurangan Pelunasan Lelang<br>
&nbsp;&nbsp;sebesar Rp_________________<br>
- Batas Pelunasan Lelang tanggal <br>
</div>
