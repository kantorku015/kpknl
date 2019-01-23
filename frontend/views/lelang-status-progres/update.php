<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\LelangStatusProgres */

$this->title = 'Update Lelang Status Progres: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lelang Status Progres', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lelang-status-progres-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
