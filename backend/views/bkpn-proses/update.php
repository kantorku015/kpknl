<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BkpnProses */

$this->title = 'Update Bkpn Proses: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Bkpn Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bkpn-proses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
