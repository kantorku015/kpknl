<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IkuHeaderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar IKU';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iku-header-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah IKU', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'id_ss',
            [
                'attribute' => 'id_ss',
                'value' =>function($data){
                    return $data->ss->ur_ss;
                }
            ],

            'kd_iku',
            'ur_iku:ntext',
            'tahun',
            // 'jenis',
            [
                'attribute' => 'jenis',
                'value' =>function($data){
                    return $data->jenis0->ur_jenis;
                }
            ],
            // 'satuan',
            [
                'attribute' => 'satuan',
                'value' =>function($data){
                    return $data->satuan0->ur_satuan;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
