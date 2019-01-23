<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Rekening */

$this->title = 'Update Rekening: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Rekenings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rekening-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
