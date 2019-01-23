<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\KpknlLayananProses */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Referensi Proses Layanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kpknl-layanan-proses-view">

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
            // 'id',
            // 'id_layanan',
            [
                'attribute' => 'id_seksi',
                'value' =>$model->idLayanan->ur_layanan,
            ],
            [
                'attribute' => 'id_layanan',
                'value' =>$model->idLayanan->ur_layanan,
            ],
            'ur_proses',
        ],
    ]) ?>

</div>
