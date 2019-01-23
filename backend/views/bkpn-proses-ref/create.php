<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BkpnProsesRef */

$this->title = 'Create Bkpn Proses Ref';
$this->params['breadcrumbs'][] = ['label' => 'Bkpn Proses Refs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bkpn-proses-ref-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
