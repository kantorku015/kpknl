<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\RekeningPenerimaan;
use backend\models\RekeningJenisTrn;
/* @var $this yii\web\View */
/* @var $model backend\models\RekeningPenerimaan */
/* @var $form yii\widgets\ActiveForm */
$id_parent = $_GET['id_parent'];
$tgl_awal = $_GET['tgl_awal'];
$tgl_akhir = $_GET['tgl_akhir'];

$max_id = RekeningPenerimaan::find()
        ->select('id_child')
        ->where(['id_parent'=>$id_parent])
        ->orderBy(['id_child'=>SORT_DESC])
        ->one();

    if ($max_id) {
        $id_child = $max_id->id_child + 1;
    }
    else{
        $id_child = 1;
    }
$data_rek = RekeningPenerimaan::find()
->select(['*'])
->where(['id'=>$id_parent])
->one();
$id = $data_rek->id;
// $id_parent = $data_rek->id_parent;
// $id_child = $data_rek->id_child;
$post_date = $data_rek->post_date;
$value_date = $data_rek->value_date;
$branch = $data_rek->branch;
$journal_no = $data_rek->journal_no;
$description = $data_rek->description;
$debit = $data_rek->debit;
$credit = $data_rek->credit;
$jns_trn = $data_rek->jns_trn;
$no_dokumen = $data_rek->no_dokumen;
$tgl = $data_rek->tgl;
$jam = $data_rek->jam;
$keterangan = $data_rek->keterangan;
#nominal child credit
$rph_child_credit = Yii::$app->db
    ->createCommand("SELECT sum(credit) 
        FROM rekening_penerimaan 
        where id_parent >= '$id'
        ");
$jml_rph_child_credit = $rph_child_credit->queryScalar();
$sisa_credit = $credit - $jml_rph_child_credit;
#nominal child debit
$rph_child_debit = Yii::$app->db
    ->createCommand("SELECT sum(debit) 
        FROM rekening_penerimaan 
        where id_parent >= '$id'
        ");
$jml_rph_child_debit = $rph_child_debit->queryScalar();
$sisa_debit = $debit - $jml_rph_child_debit;


if ($debit == 0) {
    $nominal = $credit;
    $sisa = $sisa_credit;
}
else{
    $nominal = $debit;
    $sisa = $sisa_debit;
}
$data_trn = RekeningJenisTrn::find()
    ->select(['*'])
    ->where(['id'=>$jns_trn])
    ->one();
    $ur_trn = $data_trn->ur_trn;
?>

 <div class="panel panel-info">
    <div class="panel-heading">
    <h4 class="text-left"><b><i class="fa fa-list"></i> Data Transaksi Induk</b></h4>
    </div>
    <div class="panel-body text-left">
    <table>
        <tr>
            <td>Jenis Transaksi</td>
            <td>:</td>
            <td><?=$ur_trn ?></td>
        </tr>
        <tr>
            <td>Nomor Jurnal</td>
            <td>:</td>
            <td><?=$journal_no ?></td>
        </tr>
        <tr>
            <td>Tanggal Jurnal</td>
            <td>:</td>
            <td><?=$tgl ?></td>
        </tr>
        <tr>
            <td>Nominal Transaksi</td>
            <td>:</td>
            <td>Rp<?=number_format($nominal,2,",",".") ?></td>
        </tr>
    </table>
    <hr>
    Maksimal dana yang dapat dipecah <b>Rp<?=number_format($sisa,2,",",".") ?></b>
    <br>
    <a class="bg-danger" href="daftar-trx?tgl_awal=<?=$tgl_awal ?>&tgl_akhir=<?=$tgl_akhir ?>#<?=$id ?>">Kembali ke daftar transaksi</a>
    </div>     


</div>

<?php
if ($sisa <> 0) {
    # code...


?>
<div class="rekening-penerimaan-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'id_parent')->textInput(['value'=>$id_parent,'type'=>'hidden'])->label(false) ?>
    <?= $form->field($model, 'id_child')->textInput(['value'=>$id_child,'type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'post_date')->textInput(['maxlength' => true,'value'=>$post_date,'type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'value_date')->textInput(['maxlength' => true,'value'=>$value_date,'type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'branch')->textInput(['maxlength' => true,'value'=>$branch,'type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'journal_no')->textInput(['maxlength' => true,'value'=>$journal_no,'type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php
    if ($debit == 0) {
        ?>
        <?= $form->field($model, 'credit')->textInput(['value'=>$credit]) ?>
        <?= $form->field($model, 'debit')->textInput(['value'=>$debit,'type'=>'hidden'])->label(false) ?>
        <?php
    }
    else{
        ?>
        <?= $form->field($model, 'credit')->textInput(['value'=>$credit,'type'=>'hidden'])->label(false) ?>
        <?= $form->field($model, 'debit')->textInput(['value'=>$debit]) ?>
        <?php
    }
    ?>


    <?php
    $ref_jenis_lelang = \yii\helpers\ArrayHelper::map(
        \backend\models\RekeningJenisTrn::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_trn'
        );
    echo $form->field($model, 'jns_trn')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $ref_jenis_lelang,
        'options' => [
            'placeholder' => 'Pilih Jenis Transaki',
        'value'=>$jns_trn,
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <?= $form->field($model, 'no_dokumen')->textInput(['maxlength' => true,'value'=>$no_dokumen]) ?>

    <?= $form->field($model, 'tgl')->textInput(['value'=>$tgl,'type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'jam')->textInput(['value'=>$jam,'type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6,'value'=>$keterangan]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php
}
?>

</div>
