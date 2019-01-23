<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\IkuTarget;
/* @var $this yii\web\View */
/* @var $model backend\models\IkuTarget */
/* @var $form yii\widgets\ActiveForm */
$max_id = IkuTarget::find()
    ->orderBy(['id'=>SORT_DESC])
    ->one();
if ($max_id) {
    $id = $max_id->id + 1;
}
else{
    $id = 1;
}
$id_pic = $_GET['id_pic'];
// echo $id_pic;
?>

<div class="iku-target-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>

    <?= $form->field($model, 'id_pic')->textInput(['value' => $model->isNewRecord ? $id_pic : $model->id_pic, 'type' => 'hidden'])->label(false) ?>

    <div class="row">
    <div class="col-md-1">
    <?= $form->field($model, 'target_q1')->textInput(['value' => $model->isNewRecord ? '' : $model->target_q1,'type' => 'text']) ?>
    </div>
    <div class="col-md-1">
    <?= $form->field($model, 'target_q2')->textInput(['value' => $model->isNewRecord ? '' : $model->target_q2,'type' => 'text']) ?>
    </div>
    <div class="col-md-1">
    <?= $form->field($model, 'target_q3')->textInput(['value' => $model->isNewRecord ? '' : $model->target_q3,'type' => 'text']) ?>
    </div>
    <div class="col-md-1">
    <?= $form->field($model, 'target_q4')->textInput(['value' => $model->isNewRecord ? '' : $model->target_q4,'type' => 'text']) ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
