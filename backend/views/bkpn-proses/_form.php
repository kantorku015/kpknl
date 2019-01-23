<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\BkpnProses;
/* @var $this yii\web\View */
/* @var $model backend\models\BkpnProses */
/* @var $form yii\widgets\ActiveForm */
$max_id = BkpnProses::find()
    ->select('id')
    ->orderBy(['id'=>SORT_DESC])
    ->one();

if ($max_id) {
    $id = $max_id->id + 1;
}
else{
    $id = 1;
}
?>

<div class="bkpn-proses-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    <div class="col-md-1">
    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true]) ?>
    </div>
    <div class="col-md-2">
    <?= $form->field($model, 'nrpn')->textInput(['value' => $model->isNewRecord ? $_GET['nrpn'] : $model->nrpn, 'readonly' => true]) ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-3">
    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\BkpnProsesRef::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_proses'
        );
    echo $form->field($model, 'id_proses')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Pilih Proses',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>
    </div>
    <div class="col-md-3">
    <?php
    echo $form->field($model, 'tgl_proses')
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
    <div class="col-md-6">
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
