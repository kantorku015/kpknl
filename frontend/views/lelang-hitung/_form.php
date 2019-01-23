<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\LelangHitung;
use frontend\models\LelangHeader;
/* @var $this yii\web\View */
/* @var $model frontend\models\LelangHitung */
/* @var $form yii\widgets\ActiveForm */

#nilai max id trn
$max_id = LelangHitung::find()
    ->select('id')
    // ->where(['tahun'=>date('Y')])
    ->orderBy(['id'=>SORT_DESC])
    ->one();

if ($max_id) {
    $id = $max_id->id + 1;
}
else{
    $id = 1;
}

// #ambil id yang dipilih
// if (isset($_POST['id_lelang'])){
//     $id_lelang = $_POST['id_lelang'];
//     #data lelang
//     $data_lelang = LelangHeader::find()
//         ->select('*')
//         ->where(['id'=>$id_lelang])
//         ->one();    
//         $uraian_barang = $data_lelang->uraian_barang;
// }
// else{
//     $uraian_barang = $model->idLelang->uraian_barang;
// }
?>

<div class="lelang-hitung-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    <div class="col-md-1">
    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true]) ?>
    </div>
    </div>

    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \frontend\models\LelangHeader::find()
        // ->where('role' => )
        ->orderBy(['uraian_barang'=>SORT_ASC])
        ->all(), 'id', 'uraian_barang'
        );
    echo $form->field($model, 'id_lelang')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Pilih Lelang',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>
    
    <div class="row">
    <div class="col-md-2">
    <?= $form->field($model, 'bl_penjual')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
    <?php
    echo $form->field($model, 'tgl_bl_penjual')
        ->widget(kartik\widgets\DatePicker::classname(),[
            'options' => ['placeholder' => 'Pilih Tanggal'],
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
    </div>

    <div class="row">
    <div class="col-md-2">
    <?= $form->field($model, 'bl_pembeli')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
    <?php
    echo $form->field($model, 'tgl_bl_pembeli')
        ->widget(kartik\widgets\DatePicker::classname(),[
            'options' => ['placeholder' => 'Pilih Tanggal'],
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
    </div>

    <div class="row">
    <div class="col-md-2">
    <?= $form->field($model, 'bl_batal')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
    <?php
    echo $form->field($model, 'tgl_bl_batal')
        ->widget(kartik\widgets\DatePicker::classname(),[
            'options' => ['placeholder' => 'Pilih Tanggal'],
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
    </div>

    <div class="row">
    <div class="col-md-2">
    <?= $form->field($model, 'pph_final')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
    <?php
    echo $form->field($model, 'tgl_pph_final')
        ->widget(kartik\widgets\DatePicker::classname(),[
            'options' => ['placeholder' => 'Pilih Tanggal'],
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
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
