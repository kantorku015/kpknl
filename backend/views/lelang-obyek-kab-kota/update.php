<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangObyekKabKota */

$this->title = 'Update Lelang Obyek Kab Kota: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Lelang Obyek Kab Kotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lelang-obyek-kab-kota-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
