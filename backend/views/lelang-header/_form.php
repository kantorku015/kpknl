<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangHeader */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-header-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stakeholder')->textInput() ?>

    <?= $form->field($model, 'uraian_barang')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'progres')->textInput() ?>

    <?= $form->field($model, 'no_rl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_rl')->textInput() ?>

    <?= $form->field($model, 'hpl')->textInput() ?>

    <?= $form->field($model, 'pejabat')->textInput() ?>

    <?= $form->field($model, 'jml_pelunasan')->textInput() ?>

    <?= $form->field($model, 'tgl_pelunasan')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
