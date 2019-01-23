<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\LelangPl;
// use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangRisalah */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-risalah-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'rl_no')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'rl_tgl')
        ->widget(kartik\widgets\DatePicker::classname(),[
            'options' => ['placeholder' => 'Pilih Tanggal'],
            'language' => 'id',
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
                'todayHighlight'  => true,
                'todayBtn' =>  true,
            ]
            ]);
    ?>


    <?php
    $ref_pl = \yii\helpers\ArrayHelper::map(
        \backend\models\LelangPl::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'nama'
        );
    echo $form->field($model, 'id_pl')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $ref_pl,
        'options' => [
            'placeholder' => 'Pilih Pejabat Lelang',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <?= $form->field($model, 'sppl_no')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'sppl_tgl')
        ->widget(kartik\widgets\DatePicker::classname(),[
            'options' => ['placeholder' => 'Pilih Tanggal'],
            'language' => 'id',
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
                'todayHighlight'  => true,
                'todayBtn' =>  true,
            ]
            ]);
    ?>

     <?= $form->field($model, 'created_by')->textInput(['value' => $model->isNewRecord ? Yii::$app->user->identity->id : $model->created_by, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'created_at')->textInput(['value' => $model->isNewRecord ? date('Y-m-d') : $model->created_at   , 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'updated_by')->textInput(['value' => $model->isNewRecord ? '' : Yii::$app->user->identity->id, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'updated_at')->textInput(['value' => $model->isNewRecord ? '' : date('Y-m-d'), 'readonly' => true,'type' => 'hidden'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
