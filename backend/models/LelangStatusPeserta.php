<?php

namespace backend\models;

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

               //tambahan
            //tambahan
              [['created_by', 'updated_by',], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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

             //tambahan
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
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
