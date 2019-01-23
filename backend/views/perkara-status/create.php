<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\PerkaraStatus */

$this->title = 'Create Perkara Status';
$this->params['breadcrumbs'][] = ['label' => 'Perkara Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkara-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
