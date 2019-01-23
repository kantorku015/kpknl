<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\LelangHeader;
use backend\models\LelangStakeholder;
use backend\models\LelangStatusProgres;
use backend\models\LelangPejabat;
/* @var $this yii\web\View */
/* @var $model backend\models\LelangHeader */
/* @var $form yii\widgets\ActiveForm */
#nilai max id trn
$max_id = LelangHeader::find()
    ->select('id')
    ->where(['tahun'=>date('Y')])
    ->orderBy(['id'=>SORT_DESC])
    ->one();

if ($max_id) {
    $id = $max_id->id + 1;
}
else{
    $id = 1;
}

?>

<div class="lelang-header-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    <div class="col-md-1">
    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true]) ?>
    </div>
    <div class="col-md-2">
    <?= $form->field($model, 'tahun')->textInput(['value' => date('Y'), 'readonly' => true]) ?>
    </div>
    </div>


    <div class="row">
    <div class="col-md-6">
    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\LelangStakeholder::find()
        // ->where('role' => )
        ->orderBy(['nama'=>SORT_ASC])
        ->all(), 'id', 'nama'
        );
    echo $form->field($model, 'stakeholder')
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
    <div class="col-md-6">
    <?= $form->field($model, 'uraian_barang')->textarea(['rows' => 6]) ?>
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-4">
    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\LelangStatusProgres::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_status'
        );
    echo $form->field($model, 'progres')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Pilih Progres',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>
    </div>
    </div>

    <hr>

    <div class="row">
    <div class="col-md-4">
    <?= $form->field($model, 'no_rl')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-4">
    <?php
    echo $form->field($model, 'tgl_rl')
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
    <div class="col-md-4">
    <?= $form->field($model, 'hpl')->textInput() ?>
    </div>
    </div>


    <div class="row">
    <div class="col-md-4">
    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\LelangPejabat::find()
        // ->where('role' => )
        ->orderBy(['nama'=>SORT_ASC])
        ->all(), 'id', 'nama'
        );
    echo $form->field($model, 'pejabat')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Pilih Pejabat',
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
    <?= $form->field($model, 'jml_pelunasan')->textInput() ?>
    </div>
    <div class="col-md-4">
    <?php
    echo $form->field($model, 'tgl_pelunasan')
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
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan Perubahan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
