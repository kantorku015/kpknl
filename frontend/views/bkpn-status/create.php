<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\BkpnStatus */

$this->title = 'Create Bkpn Status';
$this->params['breadcrumbs'][] = ['label' => 'Bkpn Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bkpn-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>