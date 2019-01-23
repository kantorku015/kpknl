<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "satker".
 *
 * @property int $id
 * @property string $kd_satker
 * @property string $ur_satker
 *
 * @property GudangPkn[] $gudangPkns
 */
class Satker extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'satker';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[/*'id',*/ 'ur_satker'], 'required'],
            [['id'], 'integer'],
            [['kd_satker'], 'string', 'max' => 6],
            [['ur_satker'], 'string', 'max' => 200],
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
            'kd_satker' => 'Kode Satker',
            'ur_satker' => 'Uraian Satker',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGudangPkns()
    {
        return $this->hasMany(GudangPkn::className(), ['id_satker' => 'id']);
    }
}
