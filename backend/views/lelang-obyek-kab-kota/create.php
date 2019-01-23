<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LelangObyekKabKota */

$this->title = 'Create Lelang Obyek Kab Kota';
$this->params['breadcrumbs'][] = ['label' => 'Lelang Obyek Kab Kotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-obyek-kab-kota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
