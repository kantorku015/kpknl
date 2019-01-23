<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BkpnStatus */

$this->title = 'Update Bkpn Status: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bkpn Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bkpn-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
