<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KpknlStakeholder */

$this->title = 'Tambah Data Stakeholder';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Stakeholder', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kpknl-stakeholder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
