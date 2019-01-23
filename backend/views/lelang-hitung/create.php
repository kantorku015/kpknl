<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\LelangHitung */

$this->title = 'Tambah Data Setor Hasil Lelang';
$this->params['breadcrumbs'][] = ['label' => 'Penatausahaan Lelang', 'url' => ['lelang/index']];
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penyetoran Hasil Lelang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-hitung-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
