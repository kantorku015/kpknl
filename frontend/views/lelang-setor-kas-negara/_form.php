<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LelangSetorKasNegara */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-setor-kas-negara-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'tgl_bl_penjual')->textInput() ?>

    <?= $form->field($model, 'tgl_bl_pembeli')->textInput() ?>

    <?= $form->field($model, 'tgl_bl_batal')->textInput() ?>

    <?= $form->field($model, 'tgl_pph_final')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
