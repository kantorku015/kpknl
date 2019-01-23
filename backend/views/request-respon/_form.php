<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RequestRespon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-respon-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'ticket_code')->textInput(['maxlength' => true,'type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'id_respon')->textInput(['type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tgl_respon')->textInput(['value' => $model->isNewRecord ? '' : date('Y-m-d'), 'readonly' => true, 'type'=>'hidden'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Kirim Komentar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
