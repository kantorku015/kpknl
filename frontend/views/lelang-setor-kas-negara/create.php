<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\LelangSetorKasNegara */

$this->title = 'Create Lelang Setor Kas Negara';
$this->params['breadcrumbs'][] = ['label' => 'Lelang Setor Kas Negaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-setor-kas-negara-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
