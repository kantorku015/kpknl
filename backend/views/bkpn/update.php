<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bkpn */

$this->title = 'Update Bkpn: ' . $model->nrpn;
$this->params['breadcrumbs'][] = ['label' => 'Daftar BKPN', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nrpn, 'url' => ['view', 'id' => $model->nrpn]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bkpn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
