<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\IkuSatuan */

$this->title = 'Create Iku Satuan';
$this->params['breadcrumbs'][] = ['label' => 'Iku Satuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iku-satuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
