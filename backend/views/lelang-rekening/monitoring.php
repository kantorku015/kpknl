<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LelangRekeningSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Monitoring Rekening';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-rekening-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<a href="daftar-trx"><p>Daftar Transaksi</p></a>
<p>Saldo Per Jenis Transaksi, Per Tanggal</p>
<p>Monitoring Distribusi Dana</p>
</div>
