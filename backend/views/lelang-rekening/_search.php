<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangRekeningSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-rekening-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'post_date') ?>

    <?= $form->field($model, 'value_date') ?>

    <?= $form->field($model, 'branch') ?>

    <?= $form->field($model, 'journal_no') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'debit') ?>

    <?php // echo $form->field($model, 'credit') ?>

    <?php // echo $form->field($model, 'jns_trn') ?>

    <?php // echo $form->field($model, 'no_dokumen') ?>

    <?php // echo $form->field($model, 'tgl') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
