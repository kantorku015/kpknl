<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lelang_header".
 *
 * @property integer $id
 * @property string $tahun
 * @property integer $stakeholder
 * @property string $uraian_barang
 * @property string $keterangan
 * @property integer $progres
 * @property string $no_rl
 * @property string $tgl_rl
 * @property double $hpl
 * @property integer $pejabat
 * @property double $jml_pelunasan
 * @property string $tgl_pelunasan
 *
 * @property LelangStatusProgres $progres0
 * @property LelangPejabat $pejabat0
 * @property LelangStakeholder $stakeholder0
 * @property LelangHitung[] $lelangHitungs
 * @property LelangUangJaminan[] $lelangUangJaminans
 */
class LelangHeader extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_header';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'stakeholder', 'uraian_barang', 'progres'], 'required'],
            [['id', 'stakeholder', 'progres', 'pejabat'], 'integer'],
            [['uraian_barang', 'keterangan'], 'string'],
            [['tgl_rl', 'tgl_pelunasan'], 'safe'],
            [['hpl', 'jml_pelunasan'], 'number'],
            [['tahun'], 'string', 'max' => 4],
            [['no_rl'], 'string', 'max' => 50],
            [['progres'], 'exist', 'skipOnError' => true, 'targetClass' => LelangStatusProgres::className(), 'targetAttribute' => ['progres' => 'id']],
            [['pejabat'], 'exist', 'skipOnError' => true, 'targetClass' => LelangPejabat::className(), 'targetAttribute' => ['pejabat' => 'id']],
            [['stakeholder'], 'exist', 'skipOnError' => true, 'targetClass' => LelangStakeholder::className(), 'targetAttribute' => ['stakeholder' => 'id']],
            
            //tambahan
            //tambahan
              [['created_by', 'updated_by',], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun' => 'Tahun',
            'stakeholder' => 'Penjual',
            'uraian_barang' => 'Uraian Barang',
            'keterangan' => 'Keterangan',
            'progres' => 'Progres Lelang',
            'no_rl' => 'Nomor Risalah Lelang',
            'tgl_rl' => 'Tanggal Risalah Lelang',
            'hpl' => 'Harga Pokok Lelang',
            'pejabat' => 'Pejabat Lelang',
            'jml_pelunasan' => 'Jumlah Pelunasan',
            'tgl_pelunasan' => 'Tanggal Pelunasan',

            //tambahan
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgres0()
    {
        return $this->hasOne(LelangStatusProgres::className(), ['id' => 'progres']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPejabat0()
    {
        return $this->hasOne(LelangPejabat::className(), ['id' => 'pejabat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStakeholder0()
    {
        return $this->hasOne(LelangStakeholder::className(), ['id' => 'stakeholder']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLelangHitungs()
    {
        return $this->hasMany(LelangHitung::className(), ['id_lelang' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLelangUangJaminans()
    {
        return $this->hasMany(LelangUangJaminan::className(), ['id_lelang' => 'id']);
    }
}
