<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangRisalah */

$this->title = 'Update Lelang Risalah: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Lelang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lelang-risalah-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
