<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RekeningSaldoAwal */

$this->title = 'Tambah Saldo Awal Rekening Lelang';
$this->params['breadcrumbs'][] = ['label' => 'Rekening Saldo Awals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekening-saldo-awal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
