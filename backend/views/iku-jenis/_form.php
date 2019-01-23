<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\IkuJenis;
/* @var $this yii\web\View */
/* @var $model backend\models\IkuJenis */
/* @var $form yii\widgets\ActiveForm */
$max_id = IkuJenis::find()
    ->orderBy(['id'=>SORT_DESC])
    ->one();
if ($max_id) {
    $id = $max_id->id + 1;
}
else{
    $id = 1;
}
?>

<div class="iku-jenis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true]) ?>

    <?= $form->field($model, 'ur_jenis')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
