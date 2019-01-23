<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\PerkaraPinjam */

if (isset($_POST['no_perkara'])){
    $no_perkara = $_POST['no_perkara'];
}
else{
    $no_perkara = 'KOSONG';
}

$this->title = 'Peminjaman Perkara Nomor '.$no_perkara;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Peminjaman Perkara', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkara-pinjam-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
    ]) ?>

</div>
