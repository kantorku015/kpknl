<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LelangSetorKasNegaraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-setor-kas-negara-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tgl_bl_penjual') ?>

    <?= $form->field($model, 'tgl_bl_pembeli') ?>

    <?= $form->field($model, 'tgl_bl_batal') ?>

    <?= $form->field($model, 'tgl_pph_final') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
