<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lelang_jenis".
 *
 * @property integer $id
 * @property string $ur_jenis
 *
 * @property LelangObyek[] $lelangObyeks
 */
class LelangJenis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_jenis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ur_jenis'], 'required'],
            [['id'], 'integer'],
            [['ur_jenis'], 'string', 'max' => 255],

             //tambahan
            [['created_by', 'updated_by', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ur_jenis' => 'Ur Jenis',

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
    public function getLelangObyeks()
    {
        return $this->hasMany(LelangObyek::className(), ['jenis_lelang' => 'id']);
    }
}
