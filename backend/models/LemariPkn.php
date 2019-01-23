<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lemari_pkn".
 *
 * @property int $id
 * @property int $id_order
 * @property string $ur_lemari
 *
 * @property GudangPkn[] $gudangPkns
 */
class LemariPkn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lemari_pkn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[/*'id',*/ 'ur_lemari'], 'required'],
            [['id', 'id_order'], 'integer'],
            [['ur_lemari'], 'string', 'max' => 100],
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
            'id_order' => 'Nomor Urut (opsional)',
            'ur_lemari' => 'Nama Lemari',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGudangPkns()
    {
        return $this->hasMany(GudangPkn::className(), ['id_lemari' => 'id']);
    }
}
