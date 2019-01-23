<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangRisalahSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-risalah-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rl_no') ?>

    <?= $form->field($model, 'rl_tgl') ?>

    <?= $form->field($model, 'id_pl') ?>

    <?= $form->field($model, 'sppl_no') ?>

    <?php // echo $form->field($model, 'sppl_tgl') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
