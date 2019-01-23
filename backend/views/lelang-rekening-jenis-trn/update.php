<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangRekeningJenisTrn */

$this->title = 'Update Lelang Rekening Jenis Trn: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Lelang Rekening Jenis Trns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lelang-rekening-jenis-trn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
