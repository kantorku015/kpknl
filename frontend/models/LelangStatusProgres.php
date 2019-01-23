<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "lelang_status_progres".
 *
 * @property integer $id
 * @property string $ur_status
 *
 * @property LelangHeader[] $lelangHeaders
 */
class LelangStatusProgres extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_status_progres';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ur_status'], 'required'],
            [['id'], 'integer'],
            [['ur_status'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ur_status' => 'Ur Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLelangHeaders()
    {
        return $this->hasMany(LelangHeader::className(), ['progres' => 'id']);
    }
}
