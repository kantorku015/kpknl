<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\LemariPkn;
use backend\models\Satker;
/* @var $this yii\web\View */
/* @var $model backend\models\GudangPkn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gudang-pkn-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php
    $ref_lemari = \yii\helpers\ArrayHelper::map(
        \backend\models\LemariPkn::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_lemari'
        );
    echo $form->field($model, 'id_lemari')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $ref_lemari,
        'options' => [
            'placeholder' => 'Pilih Lokasi Penyimpanan',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <?php
    $ref_lemari = \yii\helpers\ArrayHelper::map(
        \backend\models\Satker::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_satker'
        );
    echo $form->field($model, 'id_satker')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $ref_lemari,
        'options' => [
            'placeholder' => 'Pilih Satker',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <?= $form->field($model, 'isi_berkas')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
