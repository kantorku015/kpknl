<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RekeningJenisTrn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rekening-jenis-trn-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jns_rek')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'm_k')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ur_trn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hak_negara')->textInput() ?>

    <?= $form->field($model, 'idx1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idx2')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
