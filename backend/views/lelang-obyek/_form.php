<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangObyek */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-obyek-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'pemohon_lelang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_lelang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_lelang')->textInput() ?>

    <?= $form->field($model, 'obyek_lelang')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'obyek_lelang_sing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempat_lelang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rph_limit')->textInput() ?>

    <?= $form->field($model, 'rph_jaminan')->textInput() ?>

    <?= $form->field($model, 'balai_lelang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_lelang')->textInput() ?>

    <?= $form->field($model, 'rl_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_pemenang')->textInput() ?>

    <?= $form->field($model, 'rph_pokok')->textInput() ?>

    <?= $form->field($model, 'persen_penjual')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'persen_pembeli')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'persen_pph')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rph_batal')->textInput() ?>

    <?= $form->field($model, 'rph_wanprestasi')->textInput() ?>

    <?= $form->field($model, 'batas_lunas')->textInput() ?>

    <?= $form->field($model, 'rph_lunas')->textInput() ?>

    <?= $form->field($model, 'jurnal_rek')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_jurnal')->textInput() ?>

    <?= $form->field($model, 'kuitansi_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kuitansi_abc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_setor_hbl')->textInput() ?>

    <?= $form->field($model, 'id_setor_hbl')->textInput() ?>

    <?= $form->field($model, 'tgl_setor_pnbp')->textInput() ?>

    <?= $form->field($model, 'billing_pnbp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billing_ssp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catatan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'letak_tanah_bangunan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status_tanah_bangunan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_debitur')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_debitur')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'npwp_debitur')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'luas_tanah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'luas_bangunan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nop')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kab_kota')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
