<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\IkuHeader */

$this->title = 'Update Iku Header: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Iku Headers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="iku-header-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
