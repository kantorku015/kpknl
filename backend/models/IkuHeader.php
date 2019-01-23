<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "iku_header".
 *
 * @property int $id
 * @property int $id_ss
 * @property string $kd_iku
 * @property string $ur_iku
 * @property string $tahun
 * @property int $jenis
 * @property int $satuan
 *
 * @property IkuSs $ss
 * @property IkuJenis $jenis0
 * @property IkuSatuan $satuan0
 * @property IkuPic[] $ikuPics
 */
class IkuHeader extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iku_header';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_ss', 'kd_iku', 'ur_iku', 'tahun', 'jenis', 'satuan'], 'required'],
            [['id', 'id_ss', 'jenis', 'satuan'], 'integer'],
            [['ur_iku'], 'string'],
            [['kd_iku'], 'string', 'max' => 10],
            [['tahun'], 'string', 'max' => 4],
            [['id'], 'unique'],
            [['id_ss'], 'exist', 'skipOnError' => true, 'targetClass' => IkuSs::className(), 'targetAttribute' => ['id_ss' => 'id']],
            [['jenis'], 'exist', 'skipOnError' => true, 'targetClass' => IkuJenis::className(), 'targetAttribute' => ['jenis' => 'id']],
            [['satuan'], 'exist', 'skipOnError' => true, 'targetClass' => IkuSatuan::className(), 'targetAttribute' => ['satuan' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ss' => 'Sasaran Strategis',
            'kd_iku' => 'Kode IKU',
            'ur_iku' => 'Uraian IKU',
            'tahun' => 'Tahun',
            'jenis' => 'Jenis',
            'satuan' => 'Satuan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSs()
    {
        return $this->hasOne(IkuSs::className(), ['id' => 'id_ss']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenis0()
    {
        return $this->hasOne(IkuJenis::className(), ['id' => 'jenis']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSatuan0()
    {
        return $this->hasOne(IkuSatuan::className(), ['id' => 'satuan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIkuPics()
    {
        return $this->hasMany(IkuPic::className(), ['id_head' => 'id']);
    }
}
