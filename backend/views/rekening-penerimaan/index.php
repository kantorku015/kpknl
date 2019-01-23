<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RekeningPenerimaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rekening Penerimaans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekening-penerimaan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <a href="daftar-trx">Daftar Transaksi</a>
    |
    <a href="per-trx">Per Jenis Transaksi</a>
    |
    <a href="distribusi-dana">Distribusi Dana</a>
    |
    </p>

    <p>
        <?php 
        // echo Html::a('Create Rekening Penerimaan', ['create'], ['class' => 'btn btn-success']) 
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'id_parent',
            // 'id_child',
            // 'post_date',
            // 'value_date',
            // 'branch',
            'journal_no',
            'description:ntext',
            //'debit',
            //'credit',
            // 'jns_trn',
            [
                'attribute' => 'jns_trn',
                'value' =>function($data){
                    return $data->jnsTrn->ur_trn;
                }
            ],
            'no_dokumen',
            'tgl',
            'jam',
            'keterangan:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
