<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kpknl_layanan_proses".
 *
 * @property integer $id
 * @property integer $id_layanan
 * @property string $ur_proses
 *
 * @property KpknlLayanan $idLayanan
 */
class KpknlLayananProses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kpknl_layanan_proses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_layanan', 'ur_proses'], 'required'],
            [['id', 'id_layanan'], 'integer'],
            [['ur_proses'], 'string', 'max' => 50],
            [['id_layanan'], 'exist', 'skipOnError' => true, 'targetClass' => KpknlLayanan::className(), 'targetAttribute' => ['id_layanan' => 'id']],
            [['id_seksi'], 'exist', 'skipOnError' => true, 'targetClass' => KpknlStruktur::className(), 'targetAttribute' => ['id_seksi' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_seksi' => 'Nama Seksi',
            'id_layanan' => 'Nama Layanan',
            'ur_proses' => 'Uraian Proses',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLayanan()
    {
        return $this->hasOne(KpknlLayanan::className(), ['id' => 'id_layanan']);
    }
    public function getIdSeksi()
    {
        return $this->hasOne(KpknlStruktur::className(), ['id' => 'id_seksi']);
    }
}
