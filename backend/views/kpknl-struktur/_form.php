<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\KpknlStruktur;
/* @var $this yii\web\View */
/* @var $model backend\models\KpknlStruktur */
/* @var $form yii\widgets\ActiveForm */
#nilai max data struktur org
$max_id = KpknlStruktur::find()
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

<div class="kpknl-struktur-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => false]) ?>

    <?= $form->field($model, 'ur_seksi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ur_seksi_singk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'fafa')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan Perubahan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
