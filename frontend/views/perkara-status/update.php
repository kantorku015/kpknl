<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PerkaraStatus */

$this->title = 'Update Perkara Status: ' . $model->ur_status;
$this->params['breadcrumbs'][] = ['label' => 'Perkara Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ur_status, 'url' => ['view', 'id' => $model->ur_status]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="perkara-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
