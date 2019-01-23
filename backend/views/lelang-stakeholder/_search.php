<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LelangStakeholderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-stakeholder-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'no_id') ?>

    <?= $form->field($model, 'alamat1') ?>

    <?= $form->field($model, 'alamat2') ?>

    <?php // echo $form->field($model, 'telp') ?>

    <?php // echo $form->field($model, 'kuasa_dari') ?>

    <?php // echo $form->field($model, 'pekerjaan') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
