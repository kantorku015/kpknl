<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangPemenang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-pemenang-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'nama_pemenang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_pemenang')->textarea(['rows' => 6]) ?>

     <?= $form->field($model, 'created_by')->textInput(['value' => $model->isNewRecord ? Yii::$app->user->identity->id : $model->created_by, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'created_at')->textInput(['value' => $model->isNewRecord ? date('Y-m-d') : $model->created_at   , 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'updated_by')->textInput(['value' => $model->isNewRecord ? '' : Yii::$app->user->identity->id, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'updated_at')->textInput(['value' => $model->isNewRecord ? '' : date('Y-m-d'), 'readonly' => true,'type' => 'hidden'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    

    <?php ActiveForm::end(); ?>

</div>
