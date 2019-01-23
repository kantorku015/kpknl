<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RekeningSaldoAwal */

$this->title = 'Update Rekening Saldo Awal: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Rekening Saldo Awals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rekening-saldo-awal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
