<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GudangPkn */

$this->title = 'Tambah Berkas';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Berkas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-pkn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
