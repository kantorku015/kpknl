<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\IkuHeader;
use backend\models\IkuSatuan;
use backend\models\IkuJenis;
/* @var $this yii\web\View */
/* @var $model backend\models\IkuHeader */
/* @var $form yii\widgets\ActiveForm */
$max_id = IkuHeader::find()
    ->orderBy(['id'=>SORT_DESC])
    ->one();
if ($max_id) {
    $id = $max_id->id + 1;
}
else{
    $id = 1;
}
?>

<div class="iku-header-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true]) ?>

    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\IkuSs::find()
        ->where(['tahun' => date('Y')])
        ->orderBy(['no_urut'=>SORT_ASC])
        ->all(), 'id', 'ur_ss'
        );
    echo $form->field($model, 'id_ss')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Sasaran Strategis',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <?= $form->field($model, 'kd_iku')->textInput() ?>

    <?= $form->field($model, 'ur_iku')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tahun')->textInput(['value'=>date('Y'),'maxlength' => true]) ?>

    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\IkuJenis::find()
        // ->where(['tahun' => date('Y')])
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_jenis'
        );
    echo $form->field($model, 'jenis')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Metode Hitung',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\IkuSatuan::find()
        // ->where(['tahun' => date('Y')])
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_satuan'
        );
    echo $form->field($model, 'satuan')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Satuan IKU',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
