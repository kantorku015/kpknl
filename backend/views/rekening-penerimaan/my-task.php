<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RekeningPenerimaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tugas Bendahara';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekening-penerimaan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <p>
        <ol>
            <li>Uang Jaminan</li>
                <ul>
                    <li><a href="https://www.lelangdjkn.kemenkeu.go.id/backend" target="_blank">Approval (jika tidak auto verif)</a></li>
                    <li>Retur ke Peserta (H+1)</li>
                </ul>
            <li>
                Update Rekening Koran
                <ul>
                    <li>Download - Upload Data</li>
                    <li>Identifikasi Transaksi</li>
                    <li>Identifikasi Nomor Dokumen</li>
                    <li>Cek Kelengkapan Debit-Kredit</li>
                </ul>
            </li>
            <li>
                Cek Berkas Baru
                <br><b>LELANG</b>
                <ul>
                    <li>Pelunasan</li>
                    <li>Permohonan</li>
                    <li>Pembatalan</li>
                </ul>
                <b>PIUTANG</b>
                <ul>
                    <li>Pengantar Pembayaran</li>

                </ul>
            </li>
            <li>
                Pelaporan
                <ul>
                    <li>Konfirmasi Penerimaan</li>
                    <li>Pertanggungjawaban PNBP (SAS, Pelangi)</li>
                    <li>Saldo Rekening</li>
                </ul>
            </li>
            <li>
                Pengarsipan
                <ul>
                    <li>E-Filling (PDF: RL)</li>
                    <li>Backup Data Aplikasi (dilan,sas)</li>
                </ul>
            </li>
        </ol>
    </p>

</div>
