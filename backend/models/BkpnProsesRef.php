<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bkpn_proses_ref".
 *
 * @property int $id
 * @property string $ur_proses
 *
 * @property BkpnProses[] $bkpnProses
 */
class BkpnProsesRef extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bkpn_proses_ref';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ur_proses'], 'required'],
            [['id'], 'integer'],
            [['ur_proses'], 'string', 'max' => 50],
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
            'ur_proses' => 'Ur Proses',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBkpnProses()
    {
        return $this->hasMany(BkpnProses::className(), ['id_proses' => 'id']);
    }
}
