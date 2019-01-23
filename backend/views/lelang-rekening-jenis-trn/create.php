<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LelangRekeningJenisTrn */

$this->title = 'Create Lelang Rekening Jenis Trn';
$this->params['breadcrumbs'][] = ['label' => 'Lelang Rekening Jenis Trns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-rekening-jenis-trn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
