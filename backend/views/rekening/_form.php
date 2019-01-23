<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Rekening */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rekening-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'post_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'journal_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'debit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'credit')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
