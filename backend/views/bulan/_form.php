<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Bulan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bulan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kd_bulan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ur_bulan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
