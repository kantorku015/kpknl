<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\LelangRekening;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LelangRekeningSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rekening Koran (Lelang)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-rekening-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<h2>Daftar Transaksi</h2>
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center bg-primary">No</th>
            <th class="text-center bg-primary">Tanggal-Jam</th>
            <th class="text-center bg-primary">Masuk</th>
            <th class="text-center bg-primary">Keluar</th>
            <th class="text-center bg-primary">Transaksi</th>
            <th class="text-center bg-primary">No. Dok</th>
            <th class="text-center bg-primary">Keterangan</th>
            <th class="text-center bg-primary">Aksi</th>
        </tr>
    </thead>
    <?php
    $no=1;
    $daftar_trx = LelangRekening::find()
    ->select(['*'])
    // ->where(['rl_no'=>$model->rl_no])
    ->orderBy(['id'=>SORT_ASC])
    ->all();
    foreach ($daftar_trx as $daftar_trx) {
    	$tgl = $daftar_trx->tgl;
    	$jam = $daftar_trx->jam;
    	$masuk = $daftar_trx->credit;
    	$keluar = $daftar_trx->debit;
    	$jns_trn = $daftar_trx->jns_trn;
    	$no_dokumen = $daftar_trx->no_dokumen;
    	$keterangan = $daftar_trx->keterangan;
    	?>
	    <tbody>
	    	<tr>
	    		<td><?=$no?></td>
	    		<td><?=$tgl." | ".$jam?></td>
	    		<td class="text-right"><?=number_format($masuk,2,",",".")?></td>
	    		<td class="text-right"><?=number_format($keluar,2,",",".")?></td>
	    		<td><?=$jns_trn?></td>
	    		<td><?=$no_dokumen?></td>
	    		<td><?=$keterangan?></td>
	    		<td>ubah</td>
	    	</tr>
	    </tbody>
    	<?php
    	$no++;
    }
    ?>

</table>
</div>
