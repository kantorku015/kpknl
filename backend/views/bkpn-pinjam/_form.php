<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BkpnPinjam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bkpn-pinjam-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'nrpn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'peminjam')->textInput(['maxlength' => true]) ?>


    <?php
    echo $form->field($model, 'tgl_pinjam')
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
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_by')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'updated_by')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput(['readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
