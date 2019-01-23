<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "iku_ss".
 *
 * @property int $id
 * @property string $ur_ss
 * @property string $tahun
 *
 * @property IkuHeader[] $ikuHeaders
 */
class IkuSs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iku_ss';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ur_ss', 'tahun'], 'required'],
            [['id'], 'integer'],
            [['ur_ss'], 'string'],
            [['tahun'], 'string', 'max' => 4],
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
            'ur_ss' => 'Sasaran Strategis',
            'tahun' => 'Tahun',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIkuHeaders()
    {
        return $this->hasMany(IkuHeader::className(), ['id_ss' => 'id']);
    }
}
