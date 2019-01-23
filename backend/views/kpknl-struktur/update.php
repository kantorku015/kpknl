<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\KpknlStruktur */

$this->title = 'Ubah Data'/* . $model->id*/;
$this->params['breadcrumbs'][] = ['label' => 'Referensi Struktur Organisasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kpknl-struktur-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
