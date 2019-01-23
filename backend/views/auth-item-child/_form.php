<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AuthItemChild;
use backend\models\AuthItem;
use backend\models\BkpnStatus;
/* @var $this yii\web\View */
/* @var $model backend\models\AuthItemChild */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-child-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\AuthItem::find()
        // ->select(['name'])
        ->orderBy(['name'=>SORT_ASC])
        // ->all(), 'description','name'
        ->all(), 'name', 'description'
        // ->all()
        );
    echo $form->field($model, 'parent')
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

   <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\AuthItem::find()
        // ->where('role' => )
        ->orderBy(['name'=>SORT_ASC])
        // ->all(), 'description','name'
        ->all(), 'name', 'description'
        );
    echo $form->field($model, 'child')
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
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
