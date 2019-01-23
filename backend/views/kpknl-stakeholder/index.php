<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KpknlStakeholderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Stakeholder KPKNL';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kpknl-stakeholder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'jenis',
            'nama',
            // 'identitas',
            // 'alamat:ntext',
            // 'email:email',
            'telp',
            // 'pekerjaan',
            // 'keterangan:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
