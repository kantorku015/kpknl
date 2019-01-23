<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RequestResponRef */

$this->title = 'Update Request Respon Ref: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Request Respon Refs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="request-respon-ref-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
