<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\KpknlStakeholder;
use backend\models\HistoryMessage;

/* @var $this yii\web\View */
/* @var $model backend\models\RequestHeader */

$this->title = $model->no_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Dokumen Layanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$data_stakeholder = KpknlStakeholder::find()
    ->select(['*'])
    ->where(['id'=>$model->id_stakeholder])
    ->one();
    $nama = $data_stakeholder->nama;
    $telp = $data_stakeholder->telp;
?>
<div class="request-header-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            // 'id_stakeholder',
            [
                'attribute' => 'id_stakeholder',
                'value' =>$model->stakeholder->nama,
            ],
            'no_dokumen',
            'tgl_dok',
            'id_layanan',
            'tgl_terima',
            'ticket_code',
            'keterangan:ntext',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',
        ],
    ]) ?>

<table>
    <tr>
        <td>
        <?php

        #cek sms
            $cari_histori_sms = HistoryMessage::find()
            ->select(['*'])
            ->where(['id_header'=>$model->id])
            ->andWhere(['id_detail'=>0])
            ->andWhere(['jenis'=>'sms'])
            ->count();
        #cek wa
            $cari_histori_wa = HistoryMessage::find()
            ->select(['*'])
            ->where(['id_header'=>$model->id])
            ->andWhere(['id_detail'=>0])
            ->andWhere(['jenis'=>'wa'])
            ->count();


        $content = 
            "Yth. ".$nama.", gunakan nomor tiket ".$model->ticket_code.", untuk dokumen Anda nomor: ".$model->no_dokumen.". ".$model->keterangan.". Terimakasih. KPKNL Bekasi.";
        echo Html::beginForm('../request-header/sms','post',['class' => 'form-inline']);
            echo Html::textInput('id_req_header',$model->id,['class'=>'form-control required','type'=>'hidden']);
            echo Html::submitButton('<span class="glyphicon glyphicon-send"></span> SMS <span class="label label-warning">'.$cari_histori_sms.'</span>',[
                'class'=>'btn btn-default',
                'data' => [
                    'confirm' => 'Mau Kirim SMS ke '.$nama.' no hp: '.$telp.'?. Isi Pesan: '.$content,
                    // 'method' => 'get',
                ],
                ]);
        echo Html::endForm();
        ?>
        </td>
        <td>
        <?php
        echo Html::beginForm('../request-header/wa','post',['class' => 'form-inline']);
            echo Html::textInput('id_req_header',$model->id,['class'=>'form-control required','type'=>'hidden']);
            echo Html::submitButton('<i class="fa fa-whatsapp"></i> WA <span class="label label-warning">'.$cari_histori_wa.'</span>',[
                'class'=>'btn btn-default',
                'data' => [
                    'confirm' => 'Mau Kirim pesan Whatsapp ke '.$nama.' no hp: '.$telp.'?',
                    // 'method' => 'get',
                ],
                ]);
        echo Html::endForm();
        ?>
        </td>
        <td>
            <?= Html::a('<span class="glyphicon glyphicon-print"></span> Cetak', ['cetak', 'id' => $model->id], [
            'class' => 'btn btn-default',
            'data' => [
                // 'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        </td>
    </tr>
</table>
<?php
//     $result = sms('http://detik.com');
// print_r($result);
if (isset($content)) {
    echo $content;
}
else{
    echo "";
}

?>

</div>
