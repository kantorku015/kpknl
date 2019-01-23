<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RequestHeader */

$this->title = 'Update Request Header: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Dokumen Layanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="request-header-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
