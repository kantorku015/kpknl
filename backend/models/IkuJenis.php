<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "iku_jenis".
 *
 * @property int $id
 * @property string $ur_jenis
 *
 * @property IkuHeader[] $ikuHeaders
 */
class IkuJenis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iku_jenis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ur_jenis'], 'required'],
            [['id'], 'integer'],
            [['ur_jenis'], 'string', 'max' => 100],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ur_jenis' => 'Metode Hitung',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIkuHeaders()
    {
        return $this->hasMany(IkuHeader::className(), ['jenis' => 'id']);
    }
}
