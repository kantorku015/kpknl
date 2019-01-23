<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\IkuHeader */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Iku Headers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iku-header-view">

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
            // 'id_ss',
            [
                'attribute' => 'id_ss',
                'value' =>$model->ss->ur_ss,
            ],

            'kd_iku',
            'ur_iku:ntext',
            'tahun',
            // 'jenis',
            [
                'attribute' => 'jenis',
                'value' =>$model->jenis0->ur_jenis,
            ],
            // 'satuan',
            [
                'attribute' => 'jenis',
                'value' =>$model->satuan0->ur_satuan,
            ],
        ],
    ]) ?>

</div>
