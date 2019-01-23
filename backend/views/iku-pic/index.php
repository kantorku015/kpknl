<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IkuPicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penanggung Jawab IKU';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iku-pic-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah PIC', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'id_head',
            [
                'attribute' => 'id_head',
                'value' =>function($data){
                    return $data->head->kd_iku." - ".$data->head->ur_iku;
                }
            ],
            // 'seksi_pic',
            [
                'attribute' => 'seksi_pic',
                'value' =>function($data){
                    return $data->seksiPic->ur_seksi;
                }
            ],
            'porsi_pic',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
