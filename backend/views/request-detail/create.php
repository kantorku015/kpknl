<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RequestDetail */

$this->title = 'Tambah Data Proses Layanan';
$this->params['breadcrumbs'][] = ['label' => 'Request Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
    ]) ?>

</div>
