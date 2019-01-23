<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "perkara_status".
 *
 * @property integer $id
 * @property string $ur_status
 */




class PerkaraStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perkara_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ur_status'], 'required'],
            [['id'], 'integer'],
            [['ur_status'], 'string', 'max' => 10],
            [['ur_status'], 'unique'],
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



    public function getPerkaras()
    {
        return $this->hasMany(Perkara::className(), ['status' => 'id']);
    }
}
