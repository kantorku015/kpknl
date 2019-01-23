<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\IkuJenis */

$this->title = 'Create Iku Jenis';
$this->params['breadcrumbs'][] = ['label' => 'Iku Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iku-jenis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
