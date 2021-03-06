<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\LelangStakeholder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penatausahaan Lelang', 'url' => ['lelang/index']];
$this->params['breadcrumbs'][] = ['label' => 'Daftar Stakeholder', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-stakeholder-view">

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
            'nama',
            'no_id',
            'alamat1:ntext',
            'alamat2:ntext',
            'telp',
            'kuasa_dari',
            'pekerjaan',
            'keterangan:ntext',
        ],
    ]) ?>

</div>
