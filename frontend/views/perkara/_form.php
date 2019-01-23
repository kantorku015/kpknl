<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\BkpnStatus;
/* @var $this yii\web\View */
/* @var $model frontend\models\Perkara */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perkara-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    <div class="col-md-4">
    <?= $form->field($model, 'no_perkara')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
    <?= $form->field($model, 'tempat')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-1">
    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-4">
    <?= $form->field($model, 'nama_penggugat')->textInput(['maxlength' => true]) ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-4">
    <?= $form->field($model, 'posisi_kpknl')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-2">
    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \frontend\models\BkpnStatus::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_status'
        );
    echo $form->field($model, 'status')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Status',
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
    <div class="col-md-1">
    <?= $form->field($model, 'no_box')->textInput(['maxlength' => true]) ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-8">
    <?= $form->field($model, 'ket')->textarea(['rows' => 6]) ?>
    </div>
    </div>


    <div class="row">
    <div class="col-md-2">
    <?= $form->field($model, 'created_by')->textInput(['value' => $model->isNewRecord ? Yii::$app->user->identity->id : $model->created_by, 'readonly' => true]) ?>
    </div>
    <div class="col-md-2">
    <?= $form->field($model, 'created_at')->textInput(['value' => $model->isNewRecord ? date('Y-m-d') : $model->created_at   , 'readonly' => true]) ?>
    </div>
    <div class="col-md-2">
    <?= $form->field($model, 'updated_by')->textInput(['value' => $model->isNewRecord ? '' : Yii::$app->user->identity->id, 'readonly' => true]) ?>
    </div>
    <div class="col-md-2">
    <?= $form->field($model, 'updated_at')->textInput(['value' => $model->isNewRecord ? '' : date('Y-m-d'), 'readonly' => true]) ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
