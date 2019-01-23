<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RequestRespon */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Request Respons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-respon-view">

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
            'ticket_code',
            'id_respon',
            'comment:ntext',
            'tgl_respon',
        ],
    ]) ?>

</div>
