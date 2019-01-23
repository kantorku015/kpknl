<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\UploadForm;
use backend\models\Rekening;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RekeningPenerimaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Upload Data Bank';
$this->params['breadcrumbs'][] = $this->title;
if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];
 }
else{
    $filename = 'xx';
}
?>
<div class="rekening-penerimaan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <a href="daftar-trx">Daftar Transaksi</a>
    |
    <a href="per-trx">Per Jenis Transaksi</a>
    |
    <a href="distribusi-dana">Distribusi Dana</a>
    |
    </p>

    <p>
        <?php
            use yii\widgets\ActiveForm;
            $model = new UploadForm();
            ?>

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

            <?= $form->field($model, 'file')->fileInput() ?>

            <?= Html::submitButton('Upload', ['class' => 'btn btn-success']);?>

            <?php ActiveForm::end() ?>
    </p>
    <p>
        filename: <?=$filename ?>
    </p>

<?php
// if (isset($_GET['filename'])) {
?>
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center bg-primary">No</th>
            <th class="text-center bg-primary">Post</th>
            <th class="text-center bg-primary">Value</th>
            <th class="text-center bg-primary">Branch</th>
            <th class="text-center bg-primary">Jurnal</th>
            <th class="text-center bg-primary">Deskripsi</th>
            <th class="text-center bg-primary">Debit</th>
            <th class="text-center bg-primary">Kredit</th>
            <th class="text-center bg-primary">Aksi</th>
        </tr>
    </thead>
    <?php
   
        $no=1;
        $daftar_trx = Rekening::find()
        ->select(['*'])
        // ->where(['>=', 'tgl', $tgl_awal])
        // ->andWhere(['<=', 'tgl', $tgl_akhir])
        // ->andWhere(['id_parent'=>NULL])
        ->orderBy(['id'=>SORT_ASC])
        ->all();
        foreach ($daftar_trx as $daftar_trx) {
            $id = $daftar_trx->id;
            $post_date = $daftar_trx->post_date;
            $value_date = $daftar_trx->value_date;
            $branch = $daftar_trx->branch;
            // $id_parent = $daftar_trx->id_parent;
            // $id_child = $daftar_trx->id_child;
            // $tgl = $daftar_trx->tgl;
            $journal_no = $daftar_trx->journal_no;
            $description = $daftar_trx->description;
            $debit = $daftar_trx->debit;
            $credit = $daftar_trx->credit;
            // $jam = $daftar_trx->jam;
            // $masuk = $daftar_trx->credit;
            // $keluar = $daftar_trx->debit;
            // $jns_trn = $daftar_trx->jns_trn;
            //     $data_trn = RekeningJenisTrn::find()
            //     ->select(['*'])
            //     ->where(['id'=>$jns_trn])
            //     ->one();
            //     $ur_trn = $data_trn->ur_trn;
            // $no_dokumen = $daftar_trx->no_dokumen;
            // $keterangan = $daftar_trx->keterangan;
            // $saldo = $saldo + $masuk - $keluar;
            ?>
            <tbody>
                    <tr id=<?=$id ?>>
                        <td><?=$no?>.</td>
                        <td><?=$post_date ?></td>
                        <td><?=$value_date ?></td>
                        <td><?=$branch ?></td>
                        <td><?=$journal_no ?></td>
                        <td><?=$description ?></td>
                        <td class="text-right"><?=number_format($debit,2,",",".")?></td>
                        <td class="text-right"><?=number_format($credit,2,",",".")?></td>
                        <td>
                            aksi
                        </td>
                      </tr>
            </tbody>
            <?php
            $no++;
        }
    // }
    ?>

</table>


</div>
