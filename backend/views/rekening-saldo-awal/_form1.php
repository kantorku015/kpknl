<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RekeningSaldoAwal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rekening-saldo-awal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    // echo $form->field($model, 'id')->textInput() 
    ?>

    <?php
    $ref_trn = \yii\helpers\ArrayHelper::map(
        \backend\models\RekeningJenisTrn::find()
        ->where(['jns_rek' => 'P'])
        ->andWhere(['m_k' => 'M'])
         ->andWhere(['not', ['idx1' => '']])
        ->orderBy(['idx1'=>SORT_ASC,'idx2'=>SORT_ASC])
        ->all(), 'id', 'ur_trn'
        );
    echo $form->field($model, 'jns_trn')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $ref_trn,
        'options' => [
            'placeholder' => 'Pilih Transaksi',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <?= $form->field($model, 'jumlah')->textInput() ?>

    <?= $form->field($model, 'tgl')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
