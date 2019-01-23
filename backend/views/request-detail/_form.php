<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\RequestDetail;
use backend\models\RequestHeader;
use backend\models\KpknlStakeholder;
use backend\models\KpknlLayanan;
use backend\models\KpknlLayananProses;
/* @var $this yii\web\View */
/* @var $model backend\models\RequestDetail */
/* @var $form yii\widgets\ActiveForm */

$max_id = RequestDetail::find()
    ->select('id')
    ->orderBy(['id'=>SORT_DESC])
    ->one();

if ($max_id) {
    $id = $max_id->id + 1;
}
else{
    $id = 1;
}

$daftar_request = RequestHeader::find()
    ->select(['*'])
    ->where(['id'=>$model->id_req_header])
    ->one();
    $id_req_header = $daftar_request->id;
    $no_dokumen = $daftar_request->no_dokumen;
    $tgl_dok = $daftar_request->tgl_dok;
    $id_stakeholder = $daftar_request->id_stakeholder;
        $data_stakeholder = KpknlStakeholder::find()
            ->select(['*'])
            ->where(['id'=>$id_stakeholder])
            ->one();
            $nama = $data_stakeholder->nama;
        // $nama = $id_stakeholder;
    $tgl_terima = $daftar_request->tgl_terima;
    $ticket_code = $daftar_request->ticket_code;
    $keterangan = $daftar_request->keterangan;
    $id_layanan = $daftar_request->id_layanan;
        $data_layanan = KpknlLayanan::find()
            ->select(['*'])
            ->where(['id'=>$id_layanan])
            ->one();
            $ur_layanan = $data_layanan->ur_layanan;

?>
<table>
    <tr>
        <td>
            Layanan
        </td>
        <td>
            :
        </td>
        <td>
            <?= $ur_layanan?>
        </td>
    </tr>
    <tr>
        <td>
            Dokumen
        </td>
        <td>
            :
        </td>
        <td>
            <?= $no_dokumen.", tanggal ".date_format(date_create($tgl_dok),"d-m-Y")?>
        </td>
    </tr>
    <tr>
        <td>
            Dari
        </td>
        <td>
            :
        </td>
        <td>
            <?= $nama.", tanggal ".date_format(date_create($tgl_terima),"d-m-Y")?>
        </td>
    </tr>
    <tr>
        <td>
            Tiket
        </td>
        <td>
            :
        </td>
        <td>
            <?= $ticket_code?>
        </td>
    </tr>
    <tr>
        <td>
            Keterangan
        </td>
        <td>
            :
        </td>
        <td>
            <?= $keterangan?>
        </td>
    </tr>
</table>

<div class="request-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    <div class="col-md-1">
    <?= $form->field($model, 'id')->textInput(['value' => $model->isNewRecord ? $id : $model->id, 'readonly' => true]) ?>
    </div>
    <div class="col-md-1">
    <?= $form->field($model, 'id_req_header')->textInput(['value' => $model->isNewRecord ? $id : $model->id_req_header, 'readonly' => true]) ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-4">
     <?php
    $referensi = \yii\helpers\ArrayHelper::map(
        \backend\models\KpknlLayananProses::find()
        ->where(['id_layanan' => $id_layanan])
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_proses'
        );
    echo $form->field($model, 'id_proses')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $referensi,
        'options' => [
            'placeholder' => 'Pilih Proses',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>
    </div>
    <div class="col-md-2">
    <?php
    echo $form->field($model, 'tgl_proses')
        ->widget(kartik\widgets\DatePicker::classname(),[
            'options' => ['placeholder' => 'Pilih Tanggal'],
            'language' => 'id',
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
                'todayHighlight'  => true,
                'todayBtn' =>  true,
            ]
            ]);
    ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
    </div>
    </div>


    <div class="row">
    <div class="col-md-1">
    <?= $form->field($model, 'created_by')->textInput(['value' => $model->isNewRecord ? Yii::$app->user->identity->id : $model->created_by, 'readonly' => true]) ?>
    </div>
    <div class="col-md-1">
    <?= $form->field($model, 'created_at')->textInput(['value' => $model->isNewRecord ? date('Y-m-d') : $model->created_at   , 'readonly' => true]) ?>
    </div>
    <div class="col-md-1">
    <?= $form->field($model, 'updated_by')->textInput(['value' => $model->isNewRecord ? '' : Yii::$app->user->identity->id, 'readonly' => true]) ?>
    </div>
    <div class="col-md-1">
    <?= $form->field($model, 'updated_at')->textInput(['value' => $model->isNewRecord ? '' : date('Y-m-d'), 'readonly' => true]) ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
