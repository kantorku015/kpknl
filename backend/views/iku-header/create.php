<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\IkuHeader */

$this->title = 'Create Iku Header';
$this->params['breadcrumbs'][] = ['label' => 'Iku Headers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iku-header-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
