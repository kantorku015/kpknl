<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LelangUangJaminanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-uang-jaminan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_lelang') ?>

    <?= $form->field($model, 'peserta') ?>

    <?= $form->field($model, 'jml_jaminan') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'tgl_setor') ?>

    <?php // echo $form->field($model, 'tempat_setor') ?>

    <?php // echo $form->field($model, 'tgl_kembali') ?>

    <?php // echo $form->field($model, 'tempat_kembali') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
