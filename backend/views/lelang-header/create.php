<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\LelangHeader */

$this->title = 'Tambah Data Lelang Baru';
$this->params['breadcrumbs'][] = ['label' => 'Penatausahaan Lelang', 'url' => ['lelang/index']];
$this->params['breadcrumbs'][] = ['label' => 'Daftar Lelang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-header-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
