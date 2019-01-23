<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Satker */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="satker-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'kd_satker')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ur_satker')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
