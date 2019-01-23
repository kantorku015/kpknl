<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangSetorHblSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-setor-hbl-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sppb_no') ?>

    <?= $form->field($model, 'sppb_tgl') ?>

    <?= $form->field($model, 'surat_no') ?>

    <?= $form->field($model, 'surat_tgl') ?>

    <?php // echo $form->field($model, 'surat_perihal') ?>

    <?php // echo $form->field($model, 'rek_tujuan_no') ?>

    <?php // echo $form->field($model, 'rek_tujuan_an') ?>

    <?php // echo $form->field($model, 'rek_tujuan_bank') ?>

    <?php // echo $form->field($model, 'penjual_alamat') ?>

    <?php // echo $form->field($model, 'cf') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
