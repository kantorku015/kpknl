<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\IkuPic;
use backend\models\IkuHeader;
use backend\models\KpknlStruktur;
/* @var $this yii\web\View */
/* @var $model backend\models\IkuPic */
/* @var $form yii\widgets\ActiveForm */
$max_id = IkuPic::find()
    ->orderBy(['id'=>SORT_DESC])
    ->one();
if ($max_id) {
    $id = $max_id->id + 1;
}
else{
    $id = 1;
}
?>

<div class="iku-pic-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true]) ?>

    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\IkuHeader::find()
        // ->where(['tahun' => date('Y')])
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_iku', 'tahun'
        );
    echo $form->field($model, 'id_head')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Cari IKU',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\KpknlStruktur::find()
        // ->where(['tahun' => date('Y')])
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_seksi'
        );
    echo $form->field($model, 'seksi_pic')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Pilih Seksi',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <?= $form->field($model, 'porsi_pic')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
