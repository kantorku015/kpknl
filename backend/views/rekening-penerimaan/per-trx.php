<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\RekeningPenerimaan;
use backend\models\RekeningJenisTrn;
use backend\models\RekeningSaldoAwal;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\Select2;
// use kartik\widgets\DatePicker;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LelangRekeningSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Per Transaksi Rekening Koran | Lelang';
$this->params['breadcrumbs'][] = $this->title;

 if (isset($_GET['tgl_awal'])) {
    $tgl_awal = $_GET['tgl_awal'];
    $tgl_akhir = $_GET['tgl_akhir'];
 }
else{
    $tgl_awal = date('Y-m-d');
    $tgl_akhir = date('Y-m-d');
}

if (isset($_GET['jns_trn'])) {
    $jns_trn = $_GET['jns_trn'];
    $tipe_no_dok = $_GET['tipe_no_dok'];
 }
else{
    $jns_trn = 'XX00';
    $tipe_no_dok = 1;
}

?>
<div class="lelang-rekening-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
<a href="daftar-trx">Rekening Koran</a>
|
<a href="distribusi-dana">Distribusi Dana</a>
|
</p>
<!-- <hr> -->
<?php
    echo Html::beginForm('per-trx','get',['class' => 'form-inline']);
    ?>
    <div class="row">
     <div class="col-md-4">
    <?php
    $ref_jns_trn = \yii\helpers\ArrayHelper::map(
        \backend\models\RekeningJenisTrn::find()
        // ->where('jns_rek' => 'L')
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_trn'
        );
    echo Select2::widget([
        'name' => 'jns_trn',
        'data' => $ref_jns_trn,
        'value' => $jns_trn,
        'options' => [
            'placeholder' => 'Pilih Jenis Transaksi',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);

    // $data_tipe = ['Terisi','Kosong','Semua'];
    $data_tipe = array('Dengan Nomor Dokumen','Tanpa Nomor Dokumen','Dengan dan Tanpa Nomor Dokumen');
    echo Select2::widget([
        'name' => 'tipe_no_dok',
        'data' => $data_tipe,
        'value' => $tipe_no_dok,
        'options' => [
            'placeholder' => 'Pilih Jenis Nomor Dokumen',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])
    ?>
	</div>
     <div class="col-md-1">
    <?php
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
	<br>
    <?php
    // if (isset($_GET['jns_trn'])) {
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
            <!-- <th class="text-center bg-primary">Saldo</th> -->
            <th class="text-center bg-primary">Transaksi</th>
            <th class="text-center bg-primary">No. Dok</th>
            <th class="text-center bg-primary">Keterangan</th>
            <th class="text-center bg-primary">Aksi</th>
        </tr>
    </thead>
    <?php
   
        $no=1;
        // $saldo = $jml_saldo_awal;
        #Transaksi tertentu
        if ($jns_trn <> 'XX00') {
            #jika 0 = lengkap
            if ($tipe_no_dok == '0') {
                $daftar_trx = RekeningPenerimaan::find()
                ->select(['*'])
                ->where(['jns_trn'=>$jns_trn])
                ->andWhere(['<>','no_dokumen',''])
                ->andWhere(['<>','no_dokumen','0'])
                // ->orWhere(['no_dokumen'=>'0'])
                ->orderBy(['id'=>SORT_ASC])
                ->all();
            }
            #jika 1 = kosong
            if ($tipe_no_dok == '1') {
                $daftar_trx = RekeningPenerimaan::find()
                ->select(['*'])
                ->where(['jns_trn'=>$jns_trn])
                ->andWhere(['or',
                    ['no_dokumen'=>''],
                    ['no_dokumen'=>'0']
                ])
                // ->andWhere(['=','no_dokumen',''])
                // ->andWhere(['=','no_dokumen','0'])
                // ->orWhere(['no_dokumen'=>'0'])
                ->orderBy(['id'=>SORT_ASC])
                ->all();
            }
            #jika 3 = all
            if ($tipe_no_dok == '2') {
                $daftar_trx = RekeningPenerimaan::find()
                ->select(['*'])
                ->where(['jns_trn'=>$jns_trn])
                // ->andWhere(['<>','no_dokumen',''])
                // ->orWhere(['<>','no_dokumen','0'])
                // ->orWhere(['no_dokumen'=>'0'])
                ->orderBy(['id'=>SORT_ASC])
                ->all();
            }
        }


        #Semua Transaksi
        if ($jns_trn == 'XX00') {
            #jika 0 = lengkap
            if ($tipe_no_dok == '0') {
                $daftar_trx = RekeningPenerimaan::find()
                ->select(['*'])
                // ->where(['jns_trn'=>$jns_trn])
                ->Where(['<>','no_dokumen',''])
                ->andWhere(['<>','no_dokumen','0'])
                // ->orWhere(['no_dokumen'=>'0'])
                ->orderBy(['id'=>SORT_ASC])
                ->all();
            }
            #jika 1 = kosong
            if ($tipe_no_dok == '1') {
                $daftar_trx = RekeningPenerimaan::find()
                ->select(['*'])
                // ->where(['jns_trn'=>$jns_trn])
                ->where(['or',
                    ['no_dokumen'=>''],
                    ['no_dokumen'=>'0']
                ])
                // ->andWhere(['=','no_dokumen',''])
                // ->andWhere(['=','no_dokumen','0'])
                // ->orWhere(['no_dokumen'=>'0'])
                ->orderBy(['id'=>SORT_ASC])
                ->all();
            }
            #jika 3 = all
            if ($tipe_no_dok == '2') {
                $daftar_trx = RekeningPenerimaan::find()
                ->select(['*'])
                // ->where(['jns_trn'=>$jns_trn])
                // ->andWhere(['<>','no_dokumen',''])
                // ->orWhere(['<>','no_dokumen','0'])
                // ->orWhere(['no_dokumen'=>'0'])
                ->orderBy(['id'=>SORT_ASC])
                ->all();
            }
        }

        // $daftar_trx = RekeningPenerimaan::find()
        // ->select(['*'])
        // ->where(['jns_trn'=>$jns_trn])
        // ->orderBy(['id'=>SORT_ASC])
        // ->all();
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
            // $saldo = $saldo + $masuk - $keluar;
        	?>
            <tbody>
                    <tr id=<?=$id ?>>
                        <td><?=$no?>.</td>
                        <td><?=$journal_no ?></td>
                        <td><?=$description ?></td>
                        <td><?=$tgl." | ".$jam?></td>
                        <td class="text-right"><?=number_format($masuk,2,",",".")?></td>
                        <td class="text-right"><?=number_format($keluar,2,",",".")?></td>
                        <!-- <td class="text-right"><i> ... </i></td> -->
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
    // }
    ?>

</table>
</div>
