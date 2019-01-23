<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Bulan */

$this->title = 'Create Bulan';
$this->params['breadcrumbs'][] = ['label' => 'Bulans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bulan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
