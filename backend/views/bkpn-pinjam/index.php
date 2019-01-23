<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BkpnPinjamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Peminjaman Berkas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bkpn-pinjam-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-download"></span> Pinjam Berkas', ['bkpn/index'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'nrpn',
            'peminjam',
            'tgl_pinjam',
            'tgl_kembali',
            'keterangan:ntext',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
