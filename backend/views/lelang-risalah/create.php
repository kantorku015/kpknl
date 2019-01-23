<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LelangRisalah */

$this->title = 'Tambah RL';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Lelang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-risalah-create">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
