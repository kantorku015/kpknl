<?php

use yii\helpers\Html;
use backend\models\IkuSs;
use backend\models\IkuHeader;
use backend\models\IkuPic;
use backend\models\IkuTarget;
use backend\models\KpknlStruktur;
/* @var $this yii\web\View */
/* @var $model backend\models\IkuTarget */


// echo $id_pic;
$id_pic = $_GET['id_pic'];
    $data_pic = IkuPic::find()
        ->select(['*'])
        ->where(['id'=>$id_pic])
        ->one();
        $seksi_pic = $data_pic->seksi_pic;
        	$seksi_pic = $data_pic->seksi_pic;
				$data_seksi = KpknlStruktur::find()
				->select(['*'])
				->where(['id'=>$seksi_pic])
				->one();
				$ur_seksi = $data_seksi->ur_seksi;
				$ur_seksi_singk = $data_seksi->ur_seksi_singk;
        $id_iku = $data_pic->id_head;
            $data_iku = IkuHeader::find()
            ->select(['*'])
            ->where(['id'=>$id_iku])
            ->one();
            $id_ss = $data_iku->id_ss;
            $kd_iku = $data_iku->kd_iku;
            $ur_iku = $data_iku->ur_iku;

$this->title = 'Update Target IKU';
$this->params['breadcrumbs'][] = ['label' => 'Iku Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="iku-target-update">

    <h1><?= '['.$kd_iku.'] '.$ur_iku; ?></h1>
    <h1><?= 'Pada Seksi '.$ur_seksi; ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
