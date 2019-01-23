<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Perkara */

$this->title = 'Update Perkara: ' . $model->no_perkara;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Perkara', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_perkara, 'url' => ['view', 'id' => $model->no_perkara]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="perkara-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
