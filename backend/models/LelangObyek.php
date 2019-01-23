<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lelang_obyek".
 *
 * @property int $id
 * @property string $pemohon_lelang
 * @property string $kode_lelang
 * @property int $jenis_lelang
 * @property string $obyek_lelang
 * @property string $obyek_lelang_sing
 * @property string $tempat_lelang
 * @property string $lot
 * @property double $rph_limit
 * @property double $rph_jaminan
 * @property string $balai_lelang
 * @property int $status_lelang
 * @property string $rl_no
 * @property int $id_pemenang
 * @property double $rph_pokok
 * @property string $persen_penjual
 * @property string $persen_pembeli
 * @property string $persen_pph
 * @property double $rph_batal
 * @property double $rph_wanprestasi
 * @property string $batas_lunas
 * @property double $rph_lunas
 * @property string $jurnal_rek
 * @property string $tgl_jurnal
 * @property string $kuitansi_no
 * @property string $kuitansi_abc
 * @property string $tgl_setor_hbl
 * @property int $id_setor_hbl
 * @property string $tgl_setor_pnbp
 * @property string $billing_pnbp
 * @property string $billing_ssp
 * @property string $catatan
 * @property int $created_by
 * @property string $created_at
 * @property int $updated_by
 * @property string $updated_at
 * @property string $letak_tanah_bangunan
 * @property string $status_tanah_bangunan
 * @property string $nama_debitur
 * @property string $alamat_debitur
 * @property string $npwp_debitur
 * @property string $luas_tanah
 * @property string $luas_bangunan
 * @property string $nop
 * @property int $kab_kota
 *
 * @property LelangPemenang $pemenang
 * @property LelangSetorHbl $setorHbl
 * @property LelangStatus $statusLelang
 * @property LelangJenis $jenisLelang
 * @property LelangObyekKabKota $kabKota
 */
class LelangObyek extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_obyek';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pemohon_lelang', 'jenis_lelang', /*'obyek_lelang',*/ 'rph_limit', 'rph_jaminan', 'status_lelang'], 'required'],
            [['id', 'jenis_lelang', 'status_lelang', 'id_pemenang', 'id_setor_hbl', 'created_by', 'updated_by', 'kab_kota', 'id_jenis'], 'integer'],
            [['obyek_lelang', 'catatan', 'letak_tanah_bangunan', 'alamat_debitur'], 'string'],
            [['rph_limit', 'rph_jaminan', 'rph_pokok', 'persen_penjual', 'persen_pembeli', 'persen_pph', 'rph_batal', 'rph_wanprestasi', 'rph_lunas', 'luas_tanah', 'luas_bangunan'], 'number'],
            [['batas_lunas', 'tgl_jurnal', 'tgl_setor_hbl', 'tgl_setor_pnbp', 'created_at', 'updated_at'], 'safe'],
            [['pemohon_lelang', 'obyek_lelang_sing', 'tempat_lelang', 'balai_lelang', 'nama_debitur'], 'string', 'max' => 100],
            [['kode_lelang', 'jurnal_rek'], 'string', 'max' => 10],
            [['lot', 'kuitansi_no'], 'string', 'max' => 5],
            [['rl_no', 'npwp_debitur'], 'string', 'max' => 15],
            [['kuitansi_abc'], 'string', 'max' => 1],
            [['billing_pnbp', 'billing_ssp'], 'string', 'max' => 30],
            [['status_tanah_bangunan'], 'string', 'max' => 200],
            [['nop'], 'string', 'max' => 18],
            [['id'], 'unique'],
            [['id_pemenang'], 'exist', 'skipOnError' => true, 'targetClass' => LelangPemenang::className(), 'targetAttribute' => ['id_pemenang' => 'id']],
            [['id_setor_hbl'], 'exist', 'skipOnError' => true, 'targetClass' => LelangSetorHbl::className(), 'targetAttribute' => ['id_setor_hbl' => 'id']],
            [['status_lelang'], 'exist', 'skipOnError' => true, 'targetClass' => LelangStatus::className(), 'targetAttribute' => ['status_lelang' => 'id']],
            [['jenis_lelang'], 'exist', 'skipOnError' => true, 'targetClass' => LelangJenis::className(), 'targetAttribute' => ['jenis_lelang' => 'id']],
            [['kab_kota'], 'exist', 'skipOnError' => true, 'targetClass' => LelangObyekKabKota::className(), 'targetAttribute' => ['kab_kota' => 'id']],
            [['id_jenis'], 'exist', 'skipOnError' => true, 'targetClass' => LelangObyekJenis::className(), 'targetAttribute' => ['id_jenis' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pemohon_lelang' => 'Pemohon Lelang',
            'kode_lelang' => 'Kode Lelang',
            'jenis_lelang' => 'Jenis Lelang',
            'obyek_lelang' => 'Obyek Lelang',
            'obyek_lelang_sing' => 'Keterangan Singkat',
            'tempat_lelang' => 'Tempat Lelang',
            'lot' => 'Lot',
            'rph_limit' => 'Harga Limit (Rph)',
            'rph_jaminan' => 'Uang Jaminan',
            'balai_lelang' => 'Balai Lelang',
            'status_lelang' => 'Status Lelang',
            'rl_no' => 'Nomor RL',
            'id_pemenang' => 'Pemenang',
            'rph_pokok' => 'Pokok Lelang (Rph)',
            'persen_penjual' => 'Bea Lelang Penjual (%)',
            'persen_pembeli' => 'Bea Lelang Pembeli (%)',
            'persen_pph' => 'PPh (%)',
            'rph_batal' => 'Bea Batal (Rph)',
            'rph_wanprestasi' => 'Uang Jaminan Lelang Wanprestasi (Rph)',
            'batas_lunas' => 'Batas Pelunasan',
            'rph_lunas' => 'Jumlah Pelunasan (Rph)',
            'jurnal_rek' => 'Jurnal Rek',
            'kuitansi_no' => 'Nomor Kuitansi',
            'kuitansi_abc' => 'Nomor Sub Kuitansi',
            'tgl_jurnal' => 'Tgl Jurnal',
            'tgl_setor_hbl' => 'Tgl Setor HBL',
            'id_setor_hbl' => 'Id Setor Hbl',
            'tgl_setor_pnbp' => 'Tgl Setor PNBP',
            'billing_pnbp' => 'Billing PNBP',
            'billing_ssp' => 'Billing SSP',
            'catatan' => 'Catatan',

            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',

            'letak_tanah_bangunan' => 'Letak Tanah Bangunan',
            'status_tanah_bangunan' => 'Status Tanah Bangunan',
            'nama_debitur' => 'Nama Debitur',
            'alamat_debitur' => 'Alamat Debitur',
            'npwp_debitur' => 'NPWP Debitur',
            'luas_tanah' => 'Luas Tanah',
            'luas_bangunan' => 'Luas Bangunan',
            'nop' => 'NOP',
            'kab_kota' => 'Lokasi',
            'id_jenis' => 'Jenis Obyek',
        ];
    }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getPemenang()
    // {
    //     return $this->hasOne(LelangPemenang::className(), ['id' => 'id_pemenang']);
    // }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getSetorHbl()
    // {
    //     return $this->hasOne(LelangSetorHbl::className(), ['id' => 'id_setor_hbl']);
    // }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getStatusLelang()
    // {
    //     return $this->hasOne(LelangStatus::className(), ['id' => 'status_lelang']);
    // }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getJenisLelang()
    // {
    //     return $this->hasOne(LelangJenis::className(), ['id' => 'jenis_lelang']);
    // }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisLelang()
    {
        return $this->hasOne(LelangJenis::className(), ['id' => 'jenis_lelang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPemenang()
    {
        return $this->hasOne(LelangPemenang::className(), ['id' => 'id_pemenang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSetorHbl()
    {
        return $this->hasOne(LelangSetorHbl::className(), ['id' => 'id_setor_hbl']);
    }

    public function getStatusLelang()
    {
        return $this->hasOne(LelangStatus::className(), ['id' => 'status_lelang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKabKota()
    {
        return $this->hasOne(LelangObyekKabKota::className(), ['id' => 'kab_kota']);
    }

    public function getIdJenis()
    {
        return $this->hasOne(LelangObyekJenis::className(), ['id' => 'id_jenis']);
    }
}
