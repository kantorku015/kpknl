<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KpknlLayananProses */

$this->title = 'Tambah Data Proses Layanan';
// $this->params['breadcrumbs'][] = ['label' => 'Referensi Proses Layanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kpknl-layanan-proses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
    ]) ?>

</div>
