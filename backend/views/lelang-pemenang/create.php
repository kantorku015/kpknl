<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LelangPemenang */

$this->title = 'Tambah Data Pemenang';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Pemenang Lelang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-pemenang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
