<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangObyek */

$this->title = 'Ubah Data Obyek Lelang';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Obyek', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lelang-obyek-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    //cek tanah bangunan atau tidak
    // if ($model->letak_tanah_bangunan<>'') {
    // 	// echo "Tanah Bangunan";
    // 	echo $this->render('_form2', [
    //     'model' => $model,
    // ]);
    // }
    // else{
    // 	// echo "bukan";
    // 	echo $this->render('_form1', [
    //     'model' => $model,
    // ]);
    // }
    ?>

    <?php
    echo $this->render('_formA', [
        'model' => $model,
    ]) 
    ?>

</div>
