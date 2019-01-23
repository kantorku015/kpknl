<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\LelangJenis;
use backend\models\LelangStatus;
use backend\models\LelangPemenang;
use backend\models\LelangObyek;
use backend\models\LelangRisalah;
use backend\models\LelangSetorHbl;
use backend\models\DaftarKuitansi;

/* @var $this yii\web\View */
/* @var $model backend\models\LelangObyek */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="lelang-obyek-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="panel panel-primary">
    <div class="panel-heading">DATA POKOK LELANG (diisi oleh Pejabat Lelang)</div>
    <div class="container-fluid">
    <div class="panel-content">
<hr>
    <?= $form->field($model, 'pemohon_lelang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_lelang')->textInput(['maxlength' => true]) ?>

    <?php
    $ref_jenis_lelang = \yii\helpers\ArrayHelper::map(
        \backend\models\LelangJenis::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_jenis'
        );
    echo $form->field($model, 'jenis_lelang')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $ref_jenis_lelang,
        'options' => [
            'placeholder' => 'Pilih Jenis Lelang',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>


    <?php
    $ref_jenis_obyek = \yii\helpers\ArrayHelper::map(
        \backend\models\LelangObyekJenis::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'uraian'
        );
    echo $form->field($model, 'id_jenis')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $ref_jenis_obyek,
        'options' => [
            'placeholder' => 'Pilih Jenis Obyek',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <div class="panel-group" id="accordion">
          <div class="panel panel-success">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                URAIAN OBYEK TANAH/BANGUNAN</a>
                <a class="btn btn-info"  data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                URAIAN OBYEK NON TANAH-BANGUNAN</a>
              </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
              <div class="panel-body"><?= $form->field($model, 'letak_tanah_bangunan')->textarea(['rows' => 6, 'placeholder' => 'diisi dengan alamat obyek, contoh: Grand Residence Blok AC.14-03, Desa Cijengkol, Kecamatan Setu, Kabupaten Bekasi, Propinsi Jawa Barat']) ?>

            <?= $form->field($model, 'status_tanah_bangunan')->textInput(['maxlength' => true, 'placeholder' => 'Contoh: SHM Nomor 123/Cijengkol']) ?>

            <?= $form->field($model, 'nama_debitur')->textInput(['maxlength' => true, 'placeholder' => 'diisi nama debitur pada SHM/SHGB sesuai obyek lelang']) ?>

            <?= $form->field($model, 'alamat_debitur')->textarea(['rows' => 6, 'placeholder' => 'diisi dengan alamat debitur, jika ada']) ?>

            <?= $form->field($model, 'npwp_debitur')->textInput(['maxlength' => true, 'placeholder' => 'diisi dengan NPWP debitur, jika ada']) ?>

            <?= $form->field($model, 'luas_tanah')->textInput(['maxlength' => true, 'placeholder' => 'diisi dengan luas tanah, angka saja tanpa m2. Contoh, luas 2 m2 ditulis => 2']) ?>

            <?= $form->field($model, 'luas_bangunan')->textInput(['maxlength' => true, 'placeholder' => 'diisi dengan luas bangunan, angka saja tanpa m2. Contoh, luas 2 m2 ditulis => 2']) ?>

            <?= $form->field($model, 'nop')->textInput(['maxlength' => true, 'placeholder' => 'diisi dengan NOP obyek, jika ada']) ?>

            <?php
                $ref_kab_kota = \yii\helpers\ArrayHelper::map(
                    \backend\models\LelangObyekKabKota::find()
                    // ->where('role' => )
                    ->orderBy(['id'=>SORT_ASC])
                    ->all(), 'id', 'nama_kab_kota'
                    );
                echo $form->field($model, 'kab_kota')
                ->widget(
                    \kartik\widgets\Select2::classname(),[
                    'data' => $ref_kab_kota,
                    'options' => [
                        'placeholder' => 'Pilih Lokasi',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    ]);
                // ->textInput() 
            ?>
                
            </div>
            </div>
          </div>
          <div class="panel panel-default">
            <!-- <div class="panel-heading">
              <h4 class="panel-title">
                <a class="btn btn-info"  data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                URAIAN OBYEK NON TANAH-BANGUNAN</a>
              </h4>
            </div> -->
            <div id="collapse2" class="panel-collapse collapse">
              <div class="panel-body"><?= $form->field($model, 'obyek_lelang')->textarea(['rows' => 6, 'placeholder' => 'diisi untuk obyek lelang selain tanah dan bangunan']) ?>
            <?= $form->field($model, 'obyek_lelang_sing')->textInput(['maxlength' => true,'placeholder' => 'diisi dengan uraian singkat obyek lelang, boleh dikosongkan']) ?>
                
            </div>
            </div>
          </div>
        </div>


    <?= $form->field($model, 'tempat_lelang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rph_limit')->textInput() ?>

    <?= $form->field($model, 'rph_jaminan')->textInput() ?>

    <?= $form->field($model, 'balai_lelang')->textInput(['maxlength' => true]) ?>

    <?php
    $ref_lelang_status = \yii\helpers\ArrayHelper::map(
        \backend\models\LelangStatus::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'ur_status'
        );
    echo $form->field($model, 'status_lelang')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $ref_lelang_status,
        'options' => [
            'placeholder' => 'Pilih Status Lelang',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>
</div></div></div>

<?php
$data_obyek = LelangObyek::find()
->select(['*'])
->where(['id'=>$_GET['id']])
->one();
$rl_no = $data_obyek->rl_no;
$id_pemenang = $data_obyek->id_pemenang;
if ($rl_no<>'') {
    # code...

?>


<div class="panel panel-success">
    <div class="panel-heading">PENETAPAN HASIL LELANG (diisi oleh Pejabat Lelang)</div>
    <div class="container-fluid">
    <div class="panel-content">
<hr>
    <?php
    $data_rl = LelangRisalah::find()
    ->select(['*'])
    ->where(['id'=>$rl_no])
    ->one();
    $rl_no = $data_rl->rl_no;
    $tahun_rl = Yii::$app->formatter->asDate($data_rl->rl_tgl, 'php:Y');
    ?>

    <?= $form->field($model, 'rl_no')->textInput(['readonly' => 'false','type'=>'hidden'])->label('Nomor RL: '.$rl_no.'/31/'.$tahun_rl) ?>

    <?php
    // #data pemenang
    // $data_pemenang = LelangPemenang::find()
    // ->select(['*'])
    // ->where($rl_no)
    ?>

    <?php
    $ref_pemenang = \yii\helpers\ArrayHelper::map(
        \backend\models\LelangPemenang::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'nama_pemenang'
        );
    echo $form->field($model, 'id_pemenang')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $ref_pemenang,
        'options' => [
            'placeholder' => 'Pilih Pemenang',
            'value' => $id_pemenang,
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>
    
</div></div></div>

<div class="panel panel-danger">
    <div class="panel-heading">PERHITUNGAN HASIL LELANG (diisi oleh Pejabat Lelang)</div>
    <div class="container-fluid">
    <div class="panel-content">
<hr>


    <?= $form->field($model, 'rph_pokok')->textInput() ?>

    <?= $form->field($model, 'persen_penjual')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'persen_pembeli')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'persen_pph')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rph_batal')->textInput() ?>

    <?= $form->field($model, 'rph_wanprestasi')->textInput() ?>

    <?php
    echo $form->field($model, 'batas_lunas')
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

</div></div></div>

<div class="panel panel-warning">
    <div class="panel-heading">PENATAUSAHAAN UANG HASIL LELANG <b>(diisi oleh Bendahara Penerimaan)</b></div>
    <div class="container-fluid">
    <div class="panel-content">
<hr>
    <?= $form->field($model, 'rph_lunas')->textInput() ?>

    <?= $form->field($model, 'jurnal_rek')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'tgl_jurnal')
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
    <?php
    #nilai max kuitansi
    //tahun rl
    $data_rl = LelangRisalah::find()
        ->select(['*'])
        ->where(['id'=>$model->rl_no])
        ->one();
    // $tahun_rl = $data_rl->rl_tgl;
    $tahun_rl = Yii::$app->formatter->asDate($data_rl->rl_tgl, 'php:Y');
    // $tahun_rl = '2019';
    $max_kui = DaftarKuitansi::find()
        ->select(['*'])
        ->orderBy(['kuitansi_no'=>SORT_DESC])
        ->where(['tahun'=>$tahun_rl])
        ->one();
    if ($max_kui) {
        $no_baru_kui = $max_kui->kuitansi_no+1;
        // $no_baru_kui = 'z';
    }
    else{
        $no_baru_kui = 1;
        // $no_baru_kui = 'x';
    }
// $max_kui = LelangObyek::find()
//         ->orderBy(['kuitansi_no'=>SORT_DESC])
//         // ->where([])
//         ->one();
    ?>
    <?= $form->field($model, 'kuitansi_no')->textInput(['maxlength' => true])->label('Kuitansi <code>[nomor baru tahun '.$tahun_rl.': '.$no_baru_kui.']</code>')?>

    <?= $form->field($model, 'kuitansi_abc')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'tgl_setor_hbl')
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

    <?php
    $ref_setor = \yii\helpers\ArrayHelper::map(
        \backend\models\LelangSetorHbl::find()
        // ->where('role' => )
        ->orderBy(['id'=>SORT_ASC])
        ->all(), 'id', 'surat_no'
        );
    echo $form->field($model, 'id_setor_hbl')
    ->widget(
        \kartik\widgets\Select2::classname(),[
        'data' => $ref_setor,
        'options' => [
            'placeholder' => 'Pilih Referensi',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        ]);
    // ->textInput() 
    ?>

    <?php
    echo $form->field($model, 'tgl_setor_pnbp')
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

    <?= $form->field($model, 'billing_pnbp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billing_ssp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catatan')->textarea(['rows' => 6]) ?>
</div></div></div>

<?php
}
?>

     <?= $form->field($model, 'created_by')->textInput(['value' => $model->isNewRecord ? Yii::$app->user->identity->id : $model->created_by, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'created_at')->textInput(['value' => $model->isNewRecord ? date('Y-m-d') : $model->created_at   , 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'updated_by')->textInput(['value' => $model->isNewRecord ? '' : Yii::$app->user->identity->id, 'readonly' => true, 'type' => 'hidden'])->label(false) ?>
    <?= $form->field($model, 'updated_at')->textInput(['value' => $model->isNewRecord ? '' : date('Y-m-d'), 'readonly' => true,'type' => 'hidden'])->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
