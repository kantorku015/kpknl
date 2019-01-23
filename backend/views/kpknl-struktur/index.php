<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KpknlStrukturSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referensi Struktur Organisasi KPKNL';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kpknl-struktur-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'ur_seksi',
            'ur_seksi_singk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
