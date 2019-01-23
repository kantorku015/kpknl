<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PerkaraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perkara-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'no_perkara') ?>

    <?= $form->field($model, 'tempat') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'nama_penggugat') ?>

    <?= $form->field($model, 'posisi_kpknl') ?>
    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'no_box') ?>

    <?php // echo $form->field($model, 'ket') ?>

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
