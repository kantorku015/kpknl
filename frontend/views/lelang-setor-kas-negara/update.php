<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\LelangSetorKasNegara */

$this->title = 'Update Lelang Setor Kas Negara: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lelang Setor Kas Negaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lelang-setor-kas-negara-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
