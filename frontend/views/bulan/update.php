<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bulan */

$this->title = 'Update Bulan: ' . $model->id_bulan;
$this->params['breadcrumbs'][] = ['label' => 'Bulans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_bulan, 'url' => ['view', 'id' => $model->id_bulan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bulan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
