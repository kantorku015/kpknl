<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RekeningPenerimaan */

$this->title = 'Split Transaksi Rekening Penerimaan';
$this->params['breadcrumbs'][] = ['label' => 'Rekening Penerimaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekening-penerimaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-split', [
        'model' => $model,
    ]) ?>

</div>
