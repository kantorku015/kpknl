<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\RekeningPenerimaan;
use backend\models\RekeningJenisTrn;
use backend\models\RekeningSaldoAwal;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
// use kartik\widgets\DatePicker;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LelangRekeningSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rekening Koran | Lelang';
$this->params['breadcrumbs'][] = $this->title;

 if (isset($_GET['tgl_awal'])) {
    $tgl_awal = $_GET['tgl_awal'];
    $tgl_akhir = $_GET['tgl_akhir'];
 }
else{
    $tgl_awal = date('Y-m-d');
    $tgl_akhir = date('Y-m-d');
}

?>
<div class="lelang-rekening-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
<a href="per-trx">Per Jenis Transaksi</a>
|
<a href="distribusi-dana">Distribusi Dana</a>
|
</p>

<div class="row">
    <!-- <div class="col-md-1">
    <label>Pilih Tanggal</label>
    </div> -->
    <div class="col-md-2">
    <?php
    echo Html::beginForm('../rekening-penerimaan/daftar-trx','get',['class' => 'form-inline']);
    // echo '<label>Mulai Tanggal</label>';
        echo DatePicker::widget([
            'name' => 'tgl_awal', 
            // 'value' => date('d-M-Y', strtotime('+2 days')),
            'value' => $tgl_awal,
            'options' => ['placeholder' => 'Mulai'],
            'language' => 'id',
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
                'todayHighlight'  => true,
                'todayBtn' =>  true,
            ]
        ]);
    ?>
    </div>
    <div class="col-md-2">
    <?php
     // echo '<label>Sampai Dengan</label>';
        echo DatePicker::widget([
            'name' => 'tgl_akhir', 
            // 'value' => date('d-M-Y', strtotime('+2 days')),
            // 'value' => date('d-M-Y'),
            'value' => $tgl_akhir,
            'language' => 'id',
            'options' => ['placeholder' => 'Berakhir'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
                'todayHighlight'  => true,
                'todayBtn' =>  true,
            ]
        ]);
    ?>
    </div>
    <div class="col-md-2">
    <?php
    // echo '<label>Tampilkan</label>';
    echo Html::submitButton('Tampilkan',[
        'class'=>'btn btn-success ',
        'title' => 'Tampilkan',
        'label' => [
            ]
        ]);
    echo Html::endForm();
    ?>
    </div>
</div>
<hr>
<?php
$saldo_awal = RekeningSaldoAwal::find()
->select(['*'])
->where(['jns_trn'=>'LM00'])
->one();
$rph_saldo_awal = $saldo_awal->jumlah;
$tgl_saldo_awal = $saldo_awal->tgl;
#total saldo awal
$rph_credit_awal = Yii::$app->db
    ->createCommand("SELECT sum(credit) 
        FROM rekening_penerimaan 
        where tgl >= '$tgl_saldo_awal'
        and tgl < '$tgl_awal'
        and id_parent IS NULL
        ");
$jml_rph_credit_awal = $rph_credit_awal->queryScalar() + $rph_saldo_awal;
$rph_debit_awal = Yii::$app->db
    ->createCommand("SELECT sum(debit) 
        FROM rekening_penerimaan 
        where tgl >= '$tgl_saldo_awal'
        and tgl < '$tgl_awal'
        and id_parent IS NULL
        ");
$jml_rph_debit_awal = $rph_debit_awal->queryScalar();
$jml_saldo_awal = $jml_rph_credit_awal - $jml_rph_debit_awal;

#total saldo akhir
$rph_credit_akhir = Yii::$app->db
    ->createCommand("SELECT sum(credit) 
        FROM rekening_penerimaan 
        where tgl <= '$tgl_akhir'
        and id_parent IS NULL
        ");
$jml_rph_credit_akhir = $rph_credit_akhir->queryScalar() + $rph_saldo_awal;
$rph_debit_akhir = Yii::$app->db
    ->createCommand("SELECT sum(debit) 
        FROM rekening_penerimaan 
        where tgl <= '$tgl_akhir'
        and id_parent IS NULL
        ");
$jml_rph_debit_akhir = $rph_debit_akhir->queryScalar();
$jml_saldo_akhir = $jml_rph_credit_akhir - $jml_rph_debit_akhir;
$max_journal = RekeningPenerimaan::find()
->select('journal_no')
// ->where(['tgl'=>'$tgl_akhir'])
->where(['tgl'=>$tgl_akhir])
->orderBy(['id'=>SORT_DESC])
->one();
if ($max_journal) {
    $jurnal_terakhir = $max_journal->journal_no;
}
else{
    $max_journal = RekeningPenerimaan::find()
        ->select('journal_no')
        // ->where(['tgl'=>'$tgl_akhir'])
        // ->where(['tgl'=>$tgl_akhir])
        ->orderBy(['id'=>SORT_DESC])
        ->one();
    $jurnal_terakhir = $max_journal->journal_no;
    // $jurnal_terakhir = 'xxxxxx';
}
$max_tanggal = RekeningPenerimaan::find()
->select('tgl')
// ->where(['tgl'=>'$tgl_akhir'])
->where(['tgl'=>$tgl_akhir])
->orderBy(['id'=>SORT_DESC])
->one();
if ($max_tanggal) {
    $tgl_terakhir = $max_tanggal->tgl;
}
else{
    $max_tanggal = RekeningPenerimaan::find()
        ->select('tgl')
        // ->where(['tgl'=>'$tgl_akhir'])
        // ->where(['tgl'=>$tgl_akhir])
        ->orderBy(['id'=>SORT_DESC])
        ->one();
    $tgl_terakhir = $max_tanggal->tgl;
}
?>
<p>Saldo Awal Rekening Lelang (per<code><?=$tgl_awal ?></code>): <kbd>Rp<?=number_format($jml_saldo_awal,2,",",".") ?></kbd></p>
<p>Saldo Akhir Rekening Lelang (per<code><?=$tgl_akhir ?></code>): <kbd>Rp<?=number_format($jml_saldo_akhir,2,",",".") ?></kbd> | 
    Jurnal Terakhir: <kbd><?=$jurnal_terakhir ?></kbd>
    Tanggal: <code><?=$tgl_terakhir?></code>
</p>
    <p>
    <a href="index">Lihat Index Transaksi</a>
    |
    <a href="upload">Upload Data</a>
    </p>
<?php
if (isset($_GET['tgl_awal'])) {
?>
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center bg-primary">No</th>
            <th class="text-center bg-primary">Jurnal</th>
            <th class="text-center bg-primary">Deskripsi</th>
            <th class="text-center bg-primary">Tanggal-Jam</th>
            <th class="text-center bg-primary">Masuk</th>
            <th class="text-center bg-primary">Keluar</th>
            <th class="text-center bg-primary">Saldo</th>
            <th class="text-center bg-primary">Transaksi</th>
            <th class="text-center bg-primary">No. Dok</th>
            <th class="text-center bg-primary">Keterangan</th>
            <th class="text-center bg-primary">Aksi</th>
        </tr>
    </thead>
    <?php
   
        $no=1;
        $saldo = $jml_saldo_awal;
        $daftar_trx = RekeningPenerimaan::find()
        ->select(['*'])
        ->where(['>=', 'tgl', $tgl_awal])
        ->andWhere(['<=', 'tgl', $tgl_akhir])
        ->andWhere(['id_parent'=>NULL])
        ->orderBy(['id'=>SORT_ASC])
        ->all();
        foreach ($daftar_trx as $daftar_trx) {
            $id = $daftar_trx->id;
            $id_parent = $daftar_trx->id_parent;
            $id_child = $daftar_trx->id_child;
            $tgl = $daftar_trx->tgl;
            $journal_no = $daftar_trx->journal_no;
            $description = $daftar_trx->description;
            $jam = $daftar_trx->jam;
            $masuk = $daftar_trx->credit;
            $keluar = $daftar_trx->debit;
            $jns_trn = $daftar_trx->jns_trn;
                $data_trn = RekeningJenisTrn::find()
                ->select(['*'])
                ->where(['id'=>$jns_trn])
                ->one();
                $ur_trn = $data_trn->ur_trn;
            $no_dokumen = $daftar_trx->no_dokumen;
            $keterangan = $daftar_trx->keterangan;
            $saldo = $saldo + $masuk - $keluar;
        	?>
            <tbody>
                    <tr id=<?=$id ?>>
                        <td><?=$no?>.</td>
                        <td><?=$journal_no ?></td>
                        <td><?=$description ?></td>
                        <td><?=$tgl." | ".$jam?></td>
                        <td class="text-right"><?=number_format($masuk,2,",",".")?></td>
                        <td class="text-right"><?=number_format($keluar,2,",",".")?></td>
                        <td class="text-right"><i><?=number_format($saldo,2,",",".")?></i></td>
                        <td><?=$ur_trn?></td>
                        <td><?=$no_dokumen?></td>
                        <td><?=$keterangan?></td>
                        <td>
                            <a href="split?id_parent=<?=$id ?>&tgl_awal=<?=$tgl_awal ?>&tgl_akhir=<?=$tgl_akhir ?>">split</a>
                            <!-- <a href="split?">split</a> -->
                        </td>
                      </tr>
                      <?php
                        $no_child=1;
                        // $saldo = $jml_saldo_awal;
                        $daftar_trx_child = RekeningPenerimaan::find()
                        ->select(['*'])
                        ->where(['>=', 'tgl', $tgl_awal])
                        ->andWhere(['<=', 'tgl', $tgl_akhir])
                        ->andWhere(['id_parent'=>$id])
                        ->orderBy(['id_child'=>SORT_ASC])
                        ->all();
                        foreach ($daftar_trx_child as $daftar_trx_child) {
                            $id_data = $daftar_trx_child->id;
                            $id_parent = $daftar_trx_child->id_parent;
                            $id_child = $daftar_trx_child->id_child;
                            $tgl = $daftar_trx_child->tgl;
                            $journal_no = $daftar_trx_child->journal_no;
                            $description = $daftar_trx_child->description;
                            $jam = $daftar_trx_child->jam;
                            $masuk = $daftar_trx_child->credit;
                            $keluar = $daftar_trx_child->debit;
                            if ($masuk == 0) {
                                $nominal = $keluar;
                            }
                            else{
                                $nominal = $masuk;
                            }
                            $jns_trn = $daftar_trx_child->jns_trn;
                                $data_trn = RekeningJenisTrn::find()
                                ->select(['*'])
                                ->where(['id'=>$jns_trn])
                                ->one();
                                $ur_trn = $data_trn->ur_trn;
                            $no_dokumen = $daftar_trx_child->no_dokumen;
                            $keterangan = $daftar_trx_child->keterangan;
                            // $saldo = $saldo + $masuk - $keluar;
                            ?>
                            <tbody>
                                    <tr>
                                        <td class="bg-info"></td>
                                        <td class="bg-info"><?=$no_child ?>.</td>
                                        <td class="bg-info"><?=$description ?></td>
                                        <td class="bg-info"></td>
                                        <td class="text-right bg-info"><?=number_format($masuk,2,",",".")?></td>
                                        <td class="text-right bg-info"><?=number_format($keluar,2,",",".")?></td>
                                        <td class="text-right bg-info"><i></i></td>
                                        <td class="bg-info"><?=$ur_trn?></td>
                                        <td class="bg-info"><?=$no_dokumen?></td>
                                        <td class="bg-info"><?=$keterangan?></td>
                                        <td class="bg-info">
                                            <?php
                                            echo Html::a('<span class="glyphicon glyphicon-trash"></span>', 
                                                Url::toRoute(['delete', 
                                                    'id' => $id_data,
                                                    'id_parent' => $id_parent,
                                                    'tgl_awal' => $tgl_awal,
                                                    'tgl_akhir' => $tgl_akhir
                                                ]), 
                                                ['data-method' => 'post', 
                                                'class' => 'btn btn-link',
                                                'data' => [
                                                    'confirm' => 'Mau hapus transaksi '.$ur_trn.', uraian: '.$description.' nominal Rp.'.number_format($nominal,2,",",".").'?',
                                                ], 
                                                'title'=>'Hapus Data'])
                                        ?>
                                        </td>
                                      </tr>

                            </tbody>
                            <?php
                            $no_child++;
                        }
                      ?>
    	    </tbody>
        	<?php
        	$no++;
        }
    }
    ?>

</table>
</div>
