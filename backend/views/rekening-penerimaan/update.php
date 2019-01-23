<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RekeningPenerimaan */

$this->title = 'Update Rekening Penerimaan: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Rekening Penerimaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rekening-penerimaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
