<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AuthItem;
use backend\models\User;
/* @var $this yii\web\View */
/* @var $model backend\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\User::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id','username'
        );
    echo $form->field($model, 'user_id')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Pilih User',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\AuthItem::find()
        // ->where('role' => )
        ->orderBy(['name'=>SORT_ASC])
        ->all(), 'name','description'
        );
    echo $form->field($model, 'item_name')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Pilih Akses',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>


    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
