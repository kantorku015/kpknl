<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LelangRisalah */

$this->title = 'Tambah RL Batal';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Lelang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lelang-risalah-create">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
