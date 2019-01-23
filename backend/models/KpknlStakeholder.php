<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kpknl_stakeholder".
 *
 * @property integer $id
 * @property integer $jenis
 * @property string $nama
 * @property string $identitas
 * @property string $alamat
 * @property string $email
 * @property string $telp
 * @property string $pekerjaan
 * @property string $keterangan
 *
 * @property StakeholderStatus $jenis0
 * @property RequestHeader $requestHeader
 */
class KpknlStakeholder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kpknl_stakeholder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jenis', 'nama'], 'required'],
            [['id', 'jenis'], 'integer'],
            [['alamat', 'keterangan'], 'string'],
            [['nama'], 'string', 'max' => 200],
            [['identitas', 'email'], 'string', 'max' => 100],
            [['telp'], 'string', 'max' => 20],
            [['pekerjaan'], 'string', 'max' => 50],
            [['jenis'], 'exist', 'skipOnError' => true, 'targetClass' => StakeholderStatus::className(), 'targetAttribute' => ['jenis' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis' => 'Jenis',
            'nama' => 'Nama',
            'identitas' => 'Identitas',
            'alamat' => 'Alamat',
            'email' => 'Email',
            'telp' => 'Telp',
            'pekerjaan' => 'Pekerjaan',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenis0()
    {
        return $this->hasOne(StakeholderStatus::className(), ['id' => 'jenis']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestHeader()
    {
        return $this->hasOne(RequestHeader::className(), ['id' => 'id']);
    }
}
