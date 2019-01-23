<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\KpknlLayanan;
use backend\models\KpknlStruktur;
/* @var $this yii\web\View */
/* @var $model backend\models\KpknlLayanan */
/* @var $form yii\widgets\ActiveForm */
$max_id = KpknlLayanan::find()
    ->select('id')
    ->orderBy(['id'=>SORT_DESC])
    ->one();

if ($max_id) {
    $id = $max_id->id + 1;
}
else{
    $id = 1;
}

$id_seksi = $_GET['id_seksi'];
?>

<div class="kpknl-layanan-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    <div class="col-md-1">
    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true]) ?>
    </div>

    <div class="col-md-4">
    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\KpknlStruktur::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_seksi'
        );
    echo $form->field($model, 'id_seksi')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        // 'value' => (!$model->isNewRecord ? $id_seksi: $model->id_seksi),
        'options' => [
            'placeholder' => 'Pilih Seksi',
            'value' => $id_seksi,
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-5">
    <?= $form->field($model, 'ur_layanan')->textInput(['maxlength' => true]) ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan Perubahan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
