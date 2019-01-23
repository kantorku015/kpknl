<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\IkuTarget */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Iku Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iku-target-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'id_pic',
            'target_q1',
            'target_q2',
            'target_q3',
            'target_q4',
        ],
    ]) ?>

</div>
