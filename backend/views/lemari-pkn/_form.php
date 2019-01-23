<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LemariPkn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lemari-pkn-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'id_order')->textInput() ?>

    <?= $form->field($model, 'ur_lemari')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
