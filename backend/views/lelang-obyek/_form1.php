<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\LelangJenis;
use backend\models\LelangStatus;
use backend\models\LelangPemenang;
use backend\models\LelangObyek;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangObyek */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-obyek-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="panel panel-success">
    <div class="panel-heading">DATA POKOK LELANG (diisi oleh Pejabat Lelang)</div>
    <div class="container-fluid">
    <div class="panel-content">
<hr>
    <?= $form->field($model, 'pemohon_lelang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_lelang')->textInput(['maxlength' => true]) ?>

    <?php
    $ref_jenis_lelang = \yii\helpers\ArrayHelper::map(
        \backend\models\LelangJenis::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_jenis'
        );
    echo $form->field($model, 'jenis_lelang')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $ref_jenis_lelang,
        'options' => [
            'placeholder' => 'Pilih Jenis Lelang',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <?= $form->field($model, 'obyek_lelang')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'obyek_lelang_sing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempat_lelang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rph_limit')->textInput() ?>

    <?= $form->field($model, 'rph_jaminan')->textInput() ?>

    <?= $form->field($model, 'balai_lelang')->textInput(['maxlength' => true]) ?>

    <?php
    $ref_lelang_status = \yii\helpers\ArrayHelper::map(
        \backend\models\LelangStatus::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_status'
        );
    echo $form->field($model, 'status_lelang')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $ref_lelang_status,
        'options' => [
            'placeholder' => 'Pilih Status Lelang',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>
    <?= $form->field($model, 'id_pemenang')->textInput(['value'=>0,'type'=>'hidden'])->label(false) ?>
</div></div></div>

     <?= $form->field($model, 'created_by')->textInput(['value' => $model->isNewRecord ? Yii::$app->user->identity->id : $model->created_by, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'created_at')->textInput(['value' => $model->isNewRecord ? date('Y-m-d') : $model->created_at   , 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'updated_by')->textInput(['value' => $model->isNewRecord ? '' : Yii::$app->user->identity->id, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'updated_at')->textInput(['value' => $model->isNewRecord ? '' : date('Y-m-d'), 'readonly' => true,'type' => 'hidden'])->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
