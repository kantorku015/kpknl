<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangSetorHbl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-setor-hbl-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'sppb_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sppb_tgl')->textInput() ?>

    <?= $form->field($model, 'surat_no')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'surat_tgl')
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

    <?= $form->field($model, 'surat_perihal')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rek_tujuan_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rek_tujuan_an')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rek_tujuan_bank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'penjual_alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cf')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'created_by')->textInput(['value' => $model->isNewRecord ? Yii::$app->user->identity->id : $model->created_by, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'created_at')->textInput(['value' => $model->isNewRecord ? date('Y-m-d') : $model->created_at   , 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'updated_by')->textInput(['value' => $model->isNewRecord ? '' : Yii::$app->user->identity->id, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'updated_at')->textInput(['value' => $model->isNewRecord ? '' : date('Y-m-d'), 'readonly' => true,'type' => 'hidden'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
