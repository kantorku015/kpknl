<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lelang_setor_hbl".
 *
 * @property integer $id
 * @property string $sppb_no
 * @property string $sppb_tgl
 * @property string $surat_no
 * @property string $surat_tgl
 * @property string $surat_perihal
 * @property string $rek_tujuan_no
 * @property string $rek_tujuan_an
 * @property string $rek_tujuan_bank
 * @property string $penjual_alamat
 * @property string $cf
 *
 * @property LelangObyek[] $lelangObyeks
 */
class LelangSetorHbl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_setor_hbl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'surat_no', 'surat_tgl', 'surat_perihal', 'rek_tujuan_no', 'rek_tujuan_an', 'rek_tujuan_bank'], 'required'],
            [['id'], 'integer'],
            [['sppb_tgl', 'surat_tgl'], 'safe'],
            [['surat_perihal', 'penjual_alamat'], 'string'],
            [['sppb_no', 'rek_tujuan_an', 'rek_tujuan_bank'], 'string', 'max' => 100],
            [['surat_no'], 'string', 'max' => 100],
            [['rek_tujuan_no'], 'string', 'max' => 50],
            [['cf'], 'string', 'max' => 10],

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
            'sppb_no' => 'Sppb No',
            'sppb_tgl' => 'Sppb Tgl',
            'surat_no' => 'Surat No',
            'surat_tgl' => 'Surat Tgl',
            'surat_perihal' => 'Surat Perihal',
            'rek_tujuan_no' => 'Rek Tujuan No',
            'rek_tujuan_an' => 'Rek Tujuan An',
            'rek_tujuan_bank' => 'Rek Tujuan Bank',
            'penjual_alamat' => 'Penjual Alamat',
            'cf' => 'Cf',

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
    public function getLelangObyeks()
    {
        return $this->hasMany(LelangObyek::className(), ['id_setor_hbl' => 'id']);
    }
}
