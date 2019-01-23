<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Bkpn;
use backend\models\BkpnProses;
use backend\models\BkpnProsesRef;
use backend\models\BkpnStatus;
use backend\models\Bulan;
use backend\models\RequestHeader;
use backend\models\KpknlStakeholder;
use backend\models\KpknlLayanan;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BkpnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $id = Yii::$app->request->get('$id');
$id = $_GET[('id')];
// $model = new RequestHeader($id);
$data_header = RequestHeader::find()
    ->select(['*'])
    ->where(['id'=>$id])
    ->one();
    $no_dokumen = $data_header->no_dokumen;
    $id_stakeholder = $data_header->id_stakeholder;
    $data_stakeholder = KpknlStakeholder::find()
        ->select(['*'])
        ->where(['id'=>$id_stakeholder])
        ->one();
        $nama_stakeholder = $data_stakeholder->nama;
        $telp = $data_stakeholder->telp;
    $id_layanan = $data_header->id_layanan;
    $data_layanan = KpknlLayanan::find()
        ->select(['*'])
        ->where(['id'=>$id_layanan])
        ->one();
        $ur_layanan = $data_layanan->ur_layanan;
    $tgl_dok = $data_header->tgl_dok;
    $tgl_terima = $data_header->tgl_terima;
    $ticket_code = $data_header->ticket_code;
    $keterangan = $data_header->keterangan;
// $this->title = "TANDA TERIMA";


// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="bkpn-index">
<table>
    <tr>
        <td>
        <!-- <a href="./img/015.png"><img src="./img/015.png"></a> -->
        <img src="./img/015a.png" width="110" height="100">
        &nbsp;&nbsp;
        </td>
        <td class="text-center">
            <h1>TANDA TERIMA<br>DOKUMEN</h1>
        </td>
        <td class="text-center">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <code>Nomor Tiket</code>
            <h1>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <kbd>
                &nbsp;
                <?=$ticket_code?>
                &nbsp;
                </kbd>
            </h1>
        </td>
    </tr>
</table>
    <hr>
    <table>
        <tr>
            <td>
                <h4>Nama Layanan</h4>
            </td>
            <td>:</td>
            <td>
                <h4><?=$ur_layanan?></h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Nomor Dokumen</h4>
            </td>
            <td>:</td>
            <td>
                <h4><?=$no_dokumen?>&nbsp;tgl&nbsp;<?= date_format(date_create($tgl_dok),"d-m-Y")?></h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Nama Pemohon</h4>
            </td>
            <td>:</td>
            <td>
                <h4><?= $nama_stakeholder ?> (<?= $telp ?>)</h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Keterangan</h4>
            </td>
            <td>:</td>
            <td>
                <h4><?= $keterangan ?></h4>
            </td>
        </tr>
    </table>
    <br><br>
    <div class="text-right">
    <table>
        <tr>
            <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
            <td>Bekasi, <?= date_format(date_create($tgl_terima),"d-m-Y")  ?><br>
            Diterima oleh
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
            <br>
            <br>
            <br>
            <br>
            _______________________
            </td>
        </tr>
    </table>
    </div>
<br><br><br>
    <!-- <hr> -->
    <div style="border-bottom:2px dotted;"></div>
<br>
<table>
    <tr>
        <td>
        <!-- <a href="./img/015.png"><img src="./img/015.png"></a> -->
        <img src="./img/015a.png" width="110" height="100">
        &nbsp;&nbsp;
        </td>
        <td class="text-center">
            <h1>TANDA TERIMA<br>DOKUMEN</h1>
        </td>
        <td class="text-center">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <code>Nomor Tiket</code>
            <h1>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <kbd>
                &nbsp;
                <?=$ticket_code?>
                &nbsp;
                </kbd>
            </h1>
        </td>
    </tr>
</table>
    <hr>
    <table>
        <tr>
            <td>
                <h4>Nama Layanan</h4>
            </td>
            <td>:</td>
            <td>
                <h4><?=$ur_layanan?></h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Nomor Dokumen</h4>
            </td>
            <td>:</td>
            <td>
                <h4><?=$no_dokumen?>&nbsp;tgl&nbsp;<?= date_format(date_create($tgl_dok),"d-m-Y")?></h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Nama Pemohon</h4>
            </td>
            <td>:</td>
            <td>
                <h4><?= $nama_stakeholder ?> (<?= $telp ?>)</h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Keterangan</h4>
            </td>
            <td>:</td>
            <td>
                <h4><?= $keterangan ?></h4>
            </td>
        </tr>
    </table>
    <br><br>
    <div class="text-right">
    <table>
        <tr>
            <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
            <td>Bekasi, <?= date_format(date_create($tgl_terima),"d-m-Y")  ?><br>
            Diterima oleh
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
            <br>
            <br>
            <br>
            <br>
            _______________________
            </td>
        </tr>
    </table>
    </div>
</div>
