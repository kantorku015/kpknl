<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "lelang_stakeholder".
 *
 * @property integer $id
 * @property string $nama
 * @property string $no_id
 * @property string $alamat1
 * @property string $alamat2
 * @property string $telp
 * @property string $kuasa_dari
 * @property string $pekerjaan
 * @property string $keterangan
 *
 * @property LelangHeader[] $lelangHeaders
 * @property LelangUangJaminan[] $lelangUangJaminans
 */
class LelangStakeholder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_stakeholder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nama', /*'telp'*/], 'required'],
            [['id'], 'integer'],
            [['alamat1', 'alamat2', 'keterangan'], 'string'],
            [['nama', 'kuasa_dari'], 'string', 'max' => 200],
            [['no_id', 'pekerjaan'], 'string', 'max' => 50],
            [['telp'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'no_id' => 'No ID',
            'alamat1' => 'Alamat1',
            'alamat2' => 'Alamat2',
            'telp' => 'Telp',
            'kuasa_dari' => 'Kuasa Dari',
            'pekerjaan' => 'Pekerjaan',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLelangHeaders()
    {
        return $this->hasMany(LelangHeader::className(), ['stakeholder' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLelangUangJaminans()
    {
        return $this->hasMany(LelangUangJaminan::className(), ['peserta' => 'id']);
    }
}
