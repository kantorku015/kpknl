<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KpknlStruktur */

$this->title = 'Tambah Data Struktur';
$this->params['breadcrumbs'][] = ['label' => 'Referensi Struktur Organisasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kpknl-struktur-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
