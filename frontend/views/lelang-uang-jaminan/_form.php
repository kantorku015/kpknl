<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\LelangUangJaminan;
use frontend\models\LelangHeader;
use frontend\models\LelangStatusPeserta;
/* @var $this yii\web\View */
/* @var $model frontend\models\LelangUangJaminan */
/* @var $form yii\widgets\ActiveForm */
$max_id = LelangUangJaminan::find()
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
?>

<div class="lelang-uang-jaminan-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    <div class="col-md-1">
    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true]) ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-12">
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
    </div>
    </div>

    <div class="row">
    <div class="col-md-6">
    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \frontend\models\LelangStakeholder::find()
        // ->where('role' => )
        ->orderBy(['nama'=>SORT_ASC])
        ->all(), 'id', 'nama'
        );
    echo $form->field($model, 'peserta')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Pilih Penjual',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-4">
    <?= $form->field($model, 'jml_jaminan')->textInput() ?>
    </div>
    <div class="col-md-4">
    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \frontend\models\LelangStatusPeserta::find()
        // ->where('role' => )
        ->orderBy(['ur_status'=>SORT_ASC])
        ->all(), 'id', 'ur_status'
        );
    echo $form->field($model, 'status')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Pilih Status',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-3">
    <?php
    echo $form->field($model, 'tgl_setor')
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
    <div class="col-md-3">
    <?= $form->field($model, 'tempat_setor')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
    <?php
    echo $form->field($model, 'tgl_kembali')
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
    <div class="col-md-3">
    <?= $form->field($model, 'tempat_kembali')->textInput(['maxlength' => true]) ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan Perubahan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
