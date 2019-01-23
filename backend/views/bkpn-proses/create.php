<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BkpnProses */

$this->title = 'Create Bkpn Proses';
$this->params['breadcrumbs'][] = ['label' => 'Bkpn Proses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bkpn-proses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
