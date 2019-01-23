<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\IkuSs */

$this->title = 'Create Iku Ss';
$this->params['breadcrumbs'][] = ['label' => 'Iku Sses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iku-ss-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
