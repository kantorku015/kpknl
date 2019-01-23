<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lelang_uang_jaminan".
 *
 * @property integer $id
 * @property integer $id_lelang
 * @property integer $peserta
 * @property double $jml_jaminan
 * @property integer $status
 * @property string $tgl_setor
 * @property string $tempat_setor
 * @property string $tgl_kembali
 * @property string $tempat_kembali
 *
 * @property LelangHeader $idLelang
 * @property LelangStakeholder $peserta0
 * @property LelangStatusPeserta $status0
 */
class LelangUangJaminan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_uang_jaminan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_lelang', 'peserta', 'jml_jaminan', 'status'], 'required'],
            [['id', 'id_lelang', 'peserta', 'status'], 'integer'],
            [['jml_jaminan'], 'number'],
            [['tgl_setor', 'tgl_kembali'], 'safe'],
            [['tempat_setor', 'tempat_kembali'], 'string', 'max' => 20],
            [['id_lelang'], 'exist', 'skipOnError' => true, 'targetClass' => LelangHeader::className(), 'targetAttribute' => ['id_lelang' => 'id']],
            [['peserta'], 'exist', 'skipOnError' => true, 'targetClass' => LelangStakeholder::className(), 'targetAttribute' => ['peserta' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => LelangStatusPeserta::className(), 'targetAttribute' => ['status' => 'id']],

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
            'id_lelang' => 'Obyek Lelang',
            'peserta' => 'Peserta',
            'jml_jaminan' => 'Jml Jaminan',
            'status' => 'Status Peserta',
            'tgl_setor' => 'Tanggal Setor',
            'tempat_setor' => 'Tempat Setor',
            'tgl_kembali' => 'Tanggal Pengembalian',
            'tempat_kembali' => 'Tempat Pengembalian',

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
    public function getIdLelang()
    {
        return $this->hasOne(LelangHeader::className(), ['id' => 'id_lelang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeserta0()
    {
        return $this->hasOne(LelangStakeholder::className(), ['id' => 'peserta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(LelangStatusPeserta::className(), ['id' => 'status']);
    }
}
