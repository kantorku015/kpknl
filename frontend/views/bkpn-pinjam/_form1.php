<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\BkpnPinjam;
/* @var $this yii\web\View */
/* @var $model frontend\models\BkpnPinjam */
/* @var $form yii\widgets\ActiveForm */

#nilai max id trn
$max_id = BkpnPinjam::find()
    ->orderBy(['id'=>SORT_DESC])
    ->one();
if ($max_id) {
    $id = $max_id->id + 1;
}
else{
    $id = 1;
}

#ambil nrpn yang dipilih
if (isset($_POST['nrpn'])){
    $nrpn = $_POST['nrpn'];
}
else{
    $nrpn = $model->nrpn    ;
}

?>

<div class="bkpn-pinjam-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
    <div class="col-md-1">
    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true]) ?>
    </div>
    <div class="col-md-2">
    <?= $form->field($model, 'nrpn')->textInput(['value' => $nrpn, 'readonly' => true]) ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-3">
    <?= $form->field($model, 'peminjam')->textInput(['maxlength' => true]) ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-3">
    <?php
    echo $form->field($model, 'tgl_pinjam')
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
    <div class="col-md-3">
    <?php
    echo $form->field($model, 'tgl_kembali')
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
    <div class="col-md-8">
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
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
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan Perubahan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
