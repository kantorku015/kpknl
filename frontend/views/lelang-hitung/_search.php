<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LelangHitungSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-hitung-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_lelang') ?>

    <?= $form->field($model, 'bl_penjual') ?>

    <?= $form->field($model, 'tgl_bl_penjual') ?>

    <?= $form->field($model, 'bl_pembeli') ?>

    <?php // echo $form->field($model, 'tgl_bl_pembeli') ?>

    <?php // echo $form->field($model, 'bl_batal') ?>

    <?php // echo $form->field($model, 'tgl_bl_batal') ?>

    <?php // echo $form->field($model, 'pph_final') ?>

    <?php // echo $form->field($model, 'tgl_pph_final') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
