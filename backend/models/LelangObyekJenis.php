<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lelang_obyek_jenis".
 *
 * @property int $id
 * @property string $uraian
 *
 * @property LelangObyek[] $lelangObyeks
 */
class LelangObyekJenis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_obyek_jenis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uraian'], 'required'],
            [['id'], 'integer'],
            [['uraian'], 'string', 'max' => 50],
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
            'uraian' => 'Uraian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLelangObyeks()
    {
        return $this->hasMany(LelangObyek::className(), ['id_jenis' => 'id']);
    }
}
