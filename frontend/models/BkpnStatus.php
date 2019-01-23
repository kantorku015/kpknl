<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bkpn_status".
 *
 * @property integer $id
 * @property string $ur_status
 *
 * @property Bkpn[] $bkpns
 */
class BkpnStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bkpn_status';
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBkpns()
    {
        return $this->hasMany(Bkpn::className(), ['status' => 'id']);
    }
}
