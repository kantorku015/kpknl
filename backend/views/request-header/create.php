<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RequestHeader */

$this->title = 'Input Penerimaan Dokumen Layanan';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Dokumen Layanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-header-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
