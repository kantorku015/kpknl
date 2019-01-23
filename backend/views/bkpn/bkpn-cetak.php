<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Bkpn;
use backend\models\BkpnProses;
use backend\models\BkpnProsesRef;
use backend\models\BkpnStatus;
use backend\models\Bulan;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BkpnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar BKPN';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bkpn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">NRPN | Penanggung Hutang | Penyerah Piutang | Nilai | Proses</th>
                <th class="text-center">Status-Box</th>
            </tr>
        </thead>


    <tbody>
    <?php
    #daftar penyerah piutang
    $no_berkas = 1;
    $daftar_berkas = Bkpn::find()
        ->select(['*'])
        ->distinct()
        ->orderBy(['nrpn'=>SORT_ASC])->all();
    foreach ($daftar_berkas as $daftar_berkas) {
        $nrpn = $daftar_berkas->nrpn;
        $pp_nama = $daftar_berkas->pp_nama;
        $ph_nama = $daftar_berkas->ph_nama;
        $nilai_penyerahan = $daftar_berkas->nilai_penyerahan;
        $status = $daftar_berkas->status;
            $data_status = BkpnStatus::find()
                ->select(['*'])
                ->where(['id' => $status])
                ->one();
                $ur_status = $data_status->ur_status;
        $no_box = $daftar_berkas->no_box;
        
        ?>

            <tr>
                <td class="text-center"><?=$no_berkas?>.</td>
                <td>
                    <?=$nrpn?> | 
                    <?=$ph_nama?> |
                    <?=$pp_nama?> | 
                    Rp<?=number_format($nilai_penyerahan,2,",",".")?>
                    <?php
                    $daftar_proses = BkpnProses::find()
                        ->select(['*'])
                        ->where(['nrpn'=>$nrpn])
                        ->orderBy(['tgl_proses'=>SORT_ASC])->all();
                        foreach ($daftar_proses as $daftar_proses) {
                            $nrpn = $daftar_proses->nrpn;
                            $id_proses = $daftar_proses->id_proses;
                                $data_proses_ref = BkpnProsesRef::find()
                                    ->select(['*'])
                                    ->where(['id' => $id_proses])
                                    ->one();
                                    $ur_proses = $data_proses_ref->ur_proses;
                            $tgl_proses = $daftar_proses->tgl_proses;

                            echo "<br>- ".$ur_proses." tgl.".date_format(date_create($tgl_proses),"d-m-Y");
                        }
                    ?>
                </td>
                <td class="text-center">
                    <?=$ur_status?> - 
                    <?=$no_box?>
                </td>
            </tr>
            <?php
            $no_berkas++;
        }
            ?>
        </tbody>

    </table>

</div>
