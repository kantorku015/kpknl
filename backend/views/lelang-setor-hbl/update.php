<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangSetorHbl */

$this->title = 'Update Lelang Setor Hbl: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lelang Setor Hbls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lelang-setor-hbl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
