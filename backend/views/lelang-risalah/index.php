<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LelangRisalahSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Risalah Lelang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-risalah-index">

    <?= Html::a('Obyek Lelang', ['lelang-obyek/index'], ['class' => 'btn btn-default']) ?>
    <?= Html::a('Risalah Lelang', ['lelang-risalah/index'], ['class' => 'btn btn-default']) ?>
    <?= Html::a('Pemenang Lelang', ['lelang-pemenang/index'], ['class' => 'btn btn-default']) ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <H3><code>SEBELUM MENAMBAH RL, CARI TERLEBIH DULU PADA DAFTAR RL DI BAWAH INI!</code></H3>

    <p>
        <?= Html::a('+ RL Laku', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('+ RL Batal', ['create2'], ['class' => 'btn btn-danger']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',    
            'rl_no',
            'rl_tgl',
            // 'id_pl',
            [
                'attribute' => 'id_pl',
                'value' =>function($data){
                    return $data->idPl->nama;
                }
            ],

            'sppl_no',
            'sppl_tgl',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
