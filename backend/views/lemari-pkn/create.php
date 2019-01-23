<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LemariPkn */

$this->title = 'Tambah Lemari';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Lemari', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lemari-pkn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
