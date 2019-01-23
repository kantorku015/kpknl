<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PerkaraPinjam */

$this->title = 'Update Perkara Pinjam: ' . $model->no_perkara;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Peminjaman Perkara', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_perkara, 'url' => ['view', 'id' => $model->no_perkara]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="perkara-pinjam-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
    ]) ?>

</div>
