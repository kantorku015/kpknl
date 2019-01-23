<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "iku_satuan".
 *
 * @property int $id
 * @property string $ur_satuan
 *
 * @property IkuHeader[] $ikuHeaders
 */
class IkuSatuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iku_satuan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ur_satuan'], 'required'],
            [['id'], 'integer'],
            [['ur_satuan'], 'string', 'max' => 50],
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
            'ur_satuan' => 'Ur Satuan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIkuHeaders()
    {
        return $this->hasMany(IkuHeader::className(), ['satuan' => 'id']);
    }
}
