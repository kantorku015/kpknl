<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\RekeningJenisTrn;
/* @var $this yii\web\View */
/* @var $model backend\models\RekeningPenerimaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rekening-penerimaan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>
    <?= $form->field($model, 'id_parent')->textInput() ?>
    <?= $form->field($model, 'id_child')->textInput() ?>

    <?= $form->field($model, 'post_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'journal_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'debit')->textInput() ?>

    <?= $form->field($model, 'credit')->textInput() ?>

   <?php
    $ref_jenis_lelang = \yii\helpers\ArrayHelper::map(
        \backend\models\RekeningJenisTrn::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_trn'
        );
    echo $form->field($model, 'jns_trn')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $ref_jenis_lelang,
        'options' => [
            'placeholder' => 'Pilih Jenis Transaki',
        // 'value'=>$jns_trn,
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <?= $form->field($model, 'no_dokumen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl')->textInput() ?>

    <?= $form->field($model, 'jam')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
