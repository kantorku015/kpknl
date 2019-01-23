<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BkpnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bkpn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nrpn') ?>

    <?= $form->field($model, 'ph_nama') ?>

    <?= $form->field($model, 'pp_nama') ?>

    <?= $form->field($model, 'nilai_penyerahan') ?>

    <?= $form->field($model, 'keterangan') ?>
    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'no_box') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
