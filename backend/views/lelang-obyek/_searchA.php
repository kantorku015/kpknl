<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangObyekSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lelang-obyek-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pemohon_lelang') ?>

    <?= $form->field($model, 'kode_lelang') ?>

    <?= $form->field($model, 'jenis_lelang') ?>

    <?= $form->field($model, 'obyek_lelang') ?>

    <?php // echo $form->field($model, 'obyek_lelang_sing') ?>

    <?php // echo $form->field($model, 'tempat_lelang') ?>

    <?php // echo $form->field($model, 'lot') ?>

    <?php // echo $form->field($model, 'rph_limit') ?>

    <?php // echo $form->field($model, 'rph_jaminan') ?>

    <?php // echo $form->field($model, 'balai_lelang') ?>

    <?php // echo $form->field($model, 'status_lelang') ?>

    <?php // echo $form->field($model, 'rl_no') ?>

    <?php // echo $form->field($model, 'id_pemenang') ?>

    <?php // echo $form->field($model, 'rph_pokok') ?>

    <?php // echo $form->field($model, 'persen_penjual') ?>

    <?php // echo $form->field($model, 'persen_pembeli') ?>

    <?php // echo $form->field($model, 'persen_pph') ?>

    <?php // echo $form->field($model, 'rph_batal') ?>

    <?php // echo $form->field($model, 'rph_wanprestasi') ?>

    <?php // echo $form->field($model, 'batas_lunas') ?>

    <?php // echo $form->field($model, 'rph_lunas') ?>

    <?php // echo $form->field($model, 'jurnal_rek') ?>

    <?php // echo $form->field($model, 'kuitansi_no') ?>

    <?php // echo $form->field($model, 'kuitansi_abc') ?>

    <?php // echo $form->field($model, 'tgl_setor_hbl') ?>

    <?php // echo $form->field($model, 'id_setor_hbl') ?>

    <?php // echo $form->field($model, 'tgl_setor_pnbp') ?>

    <?php // echo $form->field($model, 'billing_pnbp') ?>

    <?php // echo $form->field($model, 'billing_ssp') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
