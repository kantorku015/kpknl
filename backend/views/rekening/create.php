<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Rekening */

$this->title = 'Create Rekening';
$this->params['breadcrumbs'][] = ['label' => 'Rekenings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekening-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
