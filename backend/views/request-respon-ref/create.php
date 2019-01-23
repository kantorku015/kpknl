<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RequestResponRef */

$this->title = 'Create Request Respon Ref';
$this->params['breadcrumbs'][] = ['label' => 'Request Respon Refs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-respon-ref-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
