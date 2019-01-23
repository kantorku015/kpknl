<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LemariPkn */

$this->title = 'Ubah Data Lemari';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Lemari', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lemari-pkn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
