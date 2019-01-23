<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kpknl_struktur".
 *
 * @property integer $id
 * @property string $ur_seksi
 * @property string $ur_seksi_singk
 *
 * @property KpknlLayanan[] $kpknlLayanans
 */
class KpknlStruktur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kpknl_struktur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ur_seksi', 'ur_seksi_singk'], 'required'],
            [['id'], 'integer'],
            [['ur_seksi'], 'string', 'max' => 50],
            [['ur_seksi_singk'], 'string', 'max' => 10],
            [['fafa'], 'string', 'max' => 100],
            [['ur_seksi'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ur_seksi' => 'Nama Seksi',
            'ur_seksi_singk' => 'Singkatan',
            'fafa' => 'Icon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKpknlLayanans()
    {
        return $this->hasMany(KpknlLayanan::className(), ['id_seksi' => 'id']);
    }
    public function getKpknlLayananProses()
    {
        return $this->hasMany(KpknlLayananProses::className(), ['id_seksi' => 'id']);
    }
}
