<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KpknlLayanan */

$this->title = 'Input Layanan Baru';
// $this->params['breadcrumbs'][] = ['label' => 'Referensi Layanan KPKNL', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kpknl-layanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
    ]) ?>

</div>
