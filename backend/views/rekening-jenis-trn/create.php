<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RekeningJenisTrn */

$this->title = 'Create Rekening Jenis Trn';
$this->params['breadcrumbs'][] = ['label' => 'Rekening Jenis Trns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekening-jenis-trn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
