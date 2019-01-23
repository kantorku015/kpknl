<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangPemenang */

$this->title = 'Ubah Data Pemenang: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Pemenang Lelang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lelang-pemenang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
