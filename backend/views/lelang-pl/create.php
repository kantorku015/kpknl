<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LelangPl */

$this->title = 'Create Lelang Pl';
$this->params['breadcrumbs'][] = ['label' => 'Lelang Pls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-pl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
