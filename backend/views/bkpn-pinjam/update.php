<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BkpnPinjam */

$this->title = 'Update Bkpn Pinjam: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Peminjaman Berkas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bkpn-pinjam-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
    ]) ?>

</div>
