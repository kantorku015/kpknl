<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\BkpnPinjam */
if (isset($_POST['nrpn'])){
    $nrpn = $_POST['nrpn'];
}
else{
    $nrpn = 'KOSONG';
}

$this->title = 'Peminjaman Berkas NRPN '.$nrpn;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Peminjaman Berkas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bkpn-pinjam-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
    ]) ?>

</div>
