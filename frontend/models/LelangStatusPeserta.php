<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "lelang_status_peserta".
 *
 * @property integer $id
 * @property string $ur_status
 *
 * @property LelangUangJaminan[] $lelangUangJaminans
 */
class LelangStatusPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_status_peserta';
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
    public function getLelangUangJaminans()
    {
        return $this->hasMany(LelangUangJaminan::className(), ['status' => 'id']);
    }
}
