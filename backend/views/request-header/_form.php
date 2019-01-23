<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\RequestHeader;
use backend\models\KpknlStakeholder;
/* @var $this yii\web\View */
/* @var $model backend\models\RequestHeader */
/* @var $form yii\widgets\ActiveForm */
$max_id = RequestHeader::find()
    ->select('id')
    ->orderBy(['id'=>SORT_DESC])
    ->one();

if ($max_id) {
    $id = $max_id->id + 1;
}
else{
    $id = 1;
}

$chars = "0123456789ABCDEFGHIJKLMONPQRSTUVWXYZ";
$res = "";
for ($i = 0; $i<6; $i++){
    $res .= $chars[mt_rand(0, strlen($chars)-1)];
}
#cari res yang ada
$cari = RequestHeader::find()
    ->select(['*'])
    ->where(['ticket_code' => $res])
    ->one();
    if ($cari) {
        $res = "";
        for ($i = 0; $i<6; $i++){
            $res .= $chars[mt_rand(0, strlen($chars)-1)];
        }
    }
    else{
        $res = $res;
    }
// echo $res;

?>

<div class="request-header-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    <div class="col-md-1">
    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true, 'type'=>'hidden'])->label(false)?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-4">
    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\KpknlStakeholder::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'nama'
        );
    echo $form->field($model, 'id_stakeholder')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Pilih Nama',
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
    <div class="col-md-4">
    <?= $form->field($model, 'no_dokumen')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-4">
    <?php
    echo $form->field($model, 'tgl_dok')
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
    </div>
    </div>

    <div class="row">
    <div class="col-md-4">
    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\KpknlLayanan::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_layanan'
        );
    echo $form->field($model, 'id_layanan')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Pilih Layanan',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>
    </div>
    <div class="col-md-4">
    <?php
    echo $form->field($model, 'tgl_terima')
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
    </div>
    </div>

    <div class="row">
    <div class="col-md-2">
    <?= $form->field($model, 'ticket_code')->textInput(['value' => $model->isNewRecord ? $res : $model->ticket_code ,'readonly' => true, 'type'=>'hidden'])->label(false) ?>
    </div>
    </div>
    <?= $form->field($model, 'status')->textInput(['value' => $model->isNewRecord ? 0 : $model->status ,'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <div class="row">
    <div class="col-md-8">
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
    </div>
    </div>

    <?= $form->field($model, 'created_by')->textInput(['value' => $model->isNewRecord ? Yii::$app->user->identity->id : $model->created_by, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'created_at')->textInput(['value' => $model->isNewRecord ? date('Y-m-d') : $model->created_at   , 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'updated_by')->textInput(['value' => $model->isNewRecord ? '' : Yii::$app->user->identity->id, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'updated_at')->textInput(['value' => $model->isNewRecord ? '' : date('Y-m-d'), 'readonly' => true,'type' => 'hidden'])->label(false) ?>
    


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan Perubahan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
