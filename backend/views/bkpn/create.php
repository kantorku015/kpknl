<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Bkpn */

$this->title = 'Register Berkas Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar BKPN', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="bkpn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
