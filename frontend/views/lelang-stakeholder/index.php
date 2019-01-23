<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LelangStakeholderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Stakeholder';
$this->params['breadcrumbs'][] = ['label' => 'Penatausahaan Lelang', 'url' => ['lelang/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-stakeholder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Stakeholder', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'nama',
            // 'no_id',
            // 'alamat1:ntext',
            // 'alamat2:ntext',
            // 'telp',
            'kuasa_dari',
            // 'pekerjaan',
            // 'keterangan:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
