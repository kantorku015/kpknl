<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangRekeningJenisTrnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-rekening-jenis-trn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'jns_rek') ?>

    <?= $form->field($model, 'm_k') ?>

    <?= $form->field($model, 'ur_trn') ?>

    <?= $form->field($model, 'hak_negara') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
