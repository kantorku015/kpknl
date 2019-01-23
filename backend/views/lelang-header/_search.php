<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LelangHeaderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-header-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'stakeholder') ?>

    <?= $form->field($model, 'uraian_barang') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?= $form->field($model, 'progres') ?>

    <?php // echo $form->field($model, 'no_rl') ?>

    <?php // echo $form->field($model, 'tgl_rl') ?>

    <?php // echo $form->field($model, 'hpl') ?>

    <?php // echo $form->field($model, 'pejabat') ?>

    <?php // echo $form->field($model, 'jml_pelunasan') ?>

    <?php // echo $form->field($model, 'tgl_pelunasan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
