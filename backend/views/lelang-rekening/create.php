<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LelangRekening */

$this->title = 'Create Lelang Rekening';
$this->params['breadcrumbs'][] = ['label' => 'Lelang Rekenings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-rekening-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
