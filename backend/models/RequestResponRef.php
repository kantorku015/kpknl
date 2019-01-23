<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "request_respon_ref".
 *
 * @property int $id
 * @property string $ur_respon
 *
 * @property RequestRespon[] $requestRespons
 */
class RequestResponRef extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_respon_ref';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ur_respon'], 'required'],
            [['id'], 'integer'],
            [['ur_respon'], 'string', 'max' => 20],
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
            'ur_respon' => 'Ur Respon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestRespons()
    {
        return $this->hasMany(RequestRespon::className(), ['id_respon' => 'id']);
    }
}
