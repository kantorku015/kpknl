<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\KpknlStakeholder;

/* @var $this yii\web\View */
/* @var $model backend\models\KpknlStakeholder */
/* @var $form yii\widgets\ActiveForm */
$max_id = KpknlStakeholder::find()
    ->orderBy(['id'=>SORT_DESC])
    ->one();
if ($max_id) {
    $id = $max_id->id + 1;
}
else{
    $id = 1;
}
?>

<div class="kpknl-stakeholder-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true]) ?>

    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\StakeholderStatus::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_status'
        );
    echo $form->field($model, 'jenis')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Jenis',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'identitas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telp')->textInput(['maxlength' => true,'placeholder'=>'Contoh: 628123456789'])->label('Nomor HP, awali dengan 62 ') ?>

    <?= $form->field($model, 'pekerjaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
