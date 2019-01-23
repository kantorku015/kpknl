<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Bulan */

$this->title = $model->kd_bulan;
$this->params['breadcrumbs'][] = ['label' => 'Bulans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bulan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->kd_bulan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kd_bulan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kd_bulan',
            'ur_bulan',
        ],
    ]) ?>

</div>
