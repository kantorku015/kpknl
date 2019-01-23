<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\StakeholderStatus */

$this->title = 'Create Stakeholder Status';
$this->params['breadcrumbs'][] = ['label' => 'Stakeholder Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stakeholder-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
