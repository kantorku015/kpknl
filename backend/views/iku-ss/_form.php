<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\IkuSs;
/* @var $this yii\web\View */
/* @var $model backend\models\IkuSs */
/* @var $form yii\widgets\ActiveForm */
$max_id = IkuSs::find()
    ->orderBy(['id'=>SORT_DESC])
    ->one();
if ($max_id) {
    $id = $max_id->id + 1;
}
else{
    $id = 1;
}
?>

<div class="iku-ss-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true]) ?>

    <?= $form->field($model, 'ur_ss')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
