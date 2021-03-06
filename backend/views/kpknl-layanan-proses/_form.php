<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\models\KpknlLayananProses;
use backend\models\KpknlStruktur;
/* @var $this yii\web\View */
/* @var $model backend\models\KpknlLayananProses */
/* @var $form yii\widgets\ActiveForm */
$max_id = KpknlLayananProses::find()
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

<div class="kpknl-layanan-proses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true]) ?>

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
        'options' => [
            'placeholder' => 'Pilih Seksi',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

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
        ]
        );
?>

    

    <?= $form->field($model, 'ur_proses')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan Perubahan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
