<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kpknl_layanan".
 *
 * @property integer $id
 * @property integer $id_seksi
 * @property string $ur_layanan
 *
 * @property KpknlStruktur $idSeksi
 */
class KpknlLayanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kpknl_layanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_seksi', 'ur_layanan'], 'required'],
            [['id', 'id_seksi'], 'integer'],
            [['ur_layanan'], 'string', 'max' => 100],
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
            'ur_layanan' => 'Nama Layanan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSeksi()
    {
        return $this->hasOne(KpknlStruktur::className(), ['id' => 'id_seksi']);
    }
     public function getKpknlLayananProses()
    {
        return $this->hasMany(KpknlLayananProses::className(), ['id_layanan' => 'id']);
    }
}
