<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LelangObyek */

$this->title = 'Tambah Obyek Lelang - Batal';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Obyek', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-obyek-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-batal', [
        'model' => $model,
    ]) ?>

</div>
