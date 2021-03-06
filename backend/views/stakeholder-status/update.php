<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StakeholderStatus */

$this->title = 'Update Stakeholder Status: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Stakeholder Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="stakeholder-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
