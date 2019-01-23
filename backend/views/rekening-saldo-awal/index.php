<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\RekeningJenisTrn;
use backend\models\RekeningSaldoAwal;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RekeningSaldoAwalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Saldo Awal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekening-saldo-awal-index">

<h1>Daftar Saldo Awal</h1>
<?php
$tgl_saldo_awal = RekeningSaldoAwal::find()
->select(['tgl'])
->distinct()
->one();
$tgl = $tgl_saldo_awal->tgl;
?>
<p>Saldo awal diinput pada tanggal:<code><?=$tgl ?></code></p>
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center bg-primary">No</th>
            <th class="text-center bg-primary">Keterangan</th>
            <th class="text-center bg-primary" colspan="2">Saldo Per ...</th>
        </tr>
    </thead>
    <?php
    $array_totaljumlah = array();
    $no=1;
    $daftar_idx1 = RekeningJenisTrn::find()
    ->select(['idx1'])
    ->distinct()
    // ->where(['idx1'=>$model->rl_no])
    ->andWhere(['not', ['idx1' => '']])
    ->orderBy(['idx1'=>SORT_ASC])
    ->all();
    foreach ($daftar_idx1 as $daftar_idx1) {
        $idx1 = $daftar_idx1->idx1;
        ?>
        <tbody>
            <tr>
                <td class="bg-info"><?=$idx1 ?>.</td>
                <td colspan="3" class="bg-info">
                    <?php
                    if ($idx1 == 'A') {
                        echo "Dana Milik Pemerintah/DJKN yang belum disetorkan ke Kas Negara terdiri atas:";
                    }
                    elseif ($idx1 == 'B') {
                        echo "Dana Milik BUMN/Swasta/Pihak ketiga lainnya yang belum dipindahbukukan/ditransfer ke Pihak yang berhak terdiri atas:";
                        # code...
                    }
                    else{
                        echo "";
                    }

                    ?>
                </td>
            </tr>
                <?php
                $array_subjumlah = array();
                $daftar_idx2 = RekeningJenisTrn::find()
                    ->select(['idx2','ur_trn','id'])
                    ->distinct()
                    ->where(['idx1'=>$idx1])
                    ->andWhere(['not', ['idx2' => '']])
                    ->orderBy(['idx2'=>SORT_ASC])
                    ->all();
                    foreach ($daftar_idx2 as $daftar_idx2) {
                        $idx2 = $daftar_idx2->idx2;
                        $ur_trn = $daftar_idx2->ur_trn;
                        $id = $daftar_idx2->id;
                             $data_sa = RekeningSaldoAwal::find()
                                ->select(['*'])
                                ->where(['jns_trn'=>$id])
                                ->one();
                                if ($data_sa) {
                                    # code...
                                    $jumlah = $data_sa->jumlah;
                                }
                                else{
                                    $jumlah = 0;
                                }
                                // $jumlah = '123';
                        ?>
                        <tr>
                            <td></td>
                            <td><?=$idx2 ?>. <?=$ur_trn ?></td>
                            <td>Rp</td>
                            <td align="right"><?=number_format($jumlah,2,",",".") ?></td>
                        </tr>
                        <?php
                        array_push($array_subjumlah, $jumlah);
                    }
                    $subtotal_jumlah = array_sum($array_subjumlah);
                ?>
                <tr>
                    <td colspan="2" align="center"><b>Jumlah <?=$idx1?></b></td>
                    <td colspan="1"><b>Rp</b></td>
                    <td colspan="1" align="right"><b><?=number_format($subtotal_jumlah,2,",",".") ?></b></td>
                </tr>
        <!-- </tbody> -->
        <?php
        array_push($array_totaljumlah, $subtotal_jumlah);
    }
    $total_jumlah = array_sum($array_totaljumlah);
    ?>
            <tr>
                <td colspan="2" align="center" class="text-center bg-primary"><b>Jumlah A+B+C+D</b></td>
                <td colspan="1" class="text-center bg-primary"><b>Rp</b></td>
                <td colspan="1" align="right" class="text-right bg-primary"><b><?=number_format($total_jumlah,2,",",".") ?></b></td>
            </tr>
        </tbody>
</table>

<hr>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Saldo Awal Lelang', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Tambah Saldo Awal Piutang', ['create1'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Tambah Saldo Awal Rekening (PL)', ['create2'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'jns_trn',
            [
                'attribute' => 'jns_trn',
                'value' =>function($data){
                    return $data->jnsTrn->ur_trn;
                }
            ],
            // 'jumlah',
            [
                'attribute' => 'jumlah',
                'format' =>['decimal',2],
            ],
            'tgl',
            'keterangan:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
