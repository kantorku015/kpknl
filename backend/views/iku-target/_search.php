<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\IkuTargetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="iku-target-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_pic') ?>

    <?= $form->field($model, 'target_q1') ?>

    <?= $form->field($model, 'target_q2') ?>

    <?= $form->field($model, 'target_q3') ?>

    <?php // echo $form->field($model, 'target_q4') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
