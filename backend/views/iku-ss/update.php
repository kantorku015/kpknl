<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\IkuSs */

$this->title = 'Update Iku Ss: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Iku Sses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="iku-ss-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
