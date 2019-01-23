<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\LelangPejabat */

$this->title = 'Create Lelang Pejabat';
$this->params['breadcrumbs'][] = ['label' => 'Lelang Pejabats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-pejabat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
