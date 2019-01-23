<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\KpknlLayananProses */

$this->title = 'Ubah Proses Layanan'/* . $model->id*/;
$this->params['breadcrumbs'][] = ['label' => 'Referensi Proses Layanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kpknl-layanan-proses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
