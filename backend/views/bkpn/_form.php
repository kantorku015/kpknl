<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Bkpn;
use backend\models\BkpnStatus;
/* @var $this yii\web\View */
/* @var $model backend\models\Bkpn */
/* @var $form yii\widgets\ActiveForm */


//000007 6 digit nomor urut
#tahun ini
$tahun = date('Y');
// $tahun = '2019';
#bulan ini
$bulan = date('m');
// $bulan = '03';
#nomor terakhir
$max_id = Bkpn::find()
    ->where(['SUBSTRING(nrpn,1,4)'=>$tahun])
    ->max('nrpn');
    if ($max_id) {
        $max_id = $max_id;
    }
    else{
        $max_id = $tahun.$bulan."000000";
    }
#nomor urut
$no_urut = substr($max_id, 6, 6);
#nomor register
$noreg = ($tahun.$bulan.$no_urut)+1;
?>

<div class="bkpn-form">


    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    <div class="col-md-2">
        <?= $form->field($model, 'nrpn')->textInput(['value' => $model->isNewRecord ? $noreg : $model->nrpn, 'readonly' => false]) ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-5">
    <?= $form->field($model, 'ph_nama')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-5">
    <?= $form->field($model, 'pp_nama')->textInput(['maxlength' => true]) ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-3">
    <?= $form->field($model, 'nilai_penyerahan')->textInput() ?>
    </div>
    </div>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="row">
    <div class="col-md-2">
    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\BkpnStatus::find()
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
    <div class="col-md-1">
    <?= $form->field($model, 'no_box')->textInput() ?>
    </div>
    </div>
    <!-- </div> -->

    <!-- <div class="row"> -->
    <?= $form->field($model, 'created_by')->textInput(['value' => $model->isNewRecord ? Yii::$app->user->identity->id : $model->created_by, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'created_at')->textInput(['value' => $model->isNewRecord ? date('Y-m-d') : $model->created_at   , 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'updated_by')->textInput(['value' => $model->isNewRecord ? '' : Yii::$app->user->identity->id, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'updated_at')->textInput(['value' => $model->isNewRecord ? '' : date('Y-m-d'), 'readonly' => true,'type' => 'hidden'])->label(false) ?>
    
    <div class="row">
    <div class="col-md-2">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan Perubahan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
