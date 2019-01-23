<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RekeningPenerimaan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rekening Penerimaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekening-penerimaan-view">

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
            'post_date',
            'value_date',
            'branch',
            'journal_no',
            'description:ntext',
            'debit',
            'credit',
            'jns_trn',
            'no_dokumen',
            'tgl',
            'jam',
            'keterangan:ntext',
        ],
    ]) ?>

</div>
