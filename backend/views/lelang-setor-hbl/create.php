<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LelangSetorHbl */

$this->title = 'Create Lelang Setor Hbl';
$this->params['breadcrumbs'][] = ['label' => 'Lelang Setor Hbls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-setor-hbl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
