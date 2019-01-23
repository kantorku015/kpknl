<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lelang_pl".
 *
 * @property integer $id
 * @property string $nama
 * @property string $nip
 *
 * @property LelangRisalah[] $lelangRisalahs
 */
class LelangPl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_pl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nama', 'nip'], 'required'],
            [['id'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['nip'], 'string', 'max' => 20],

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
            'nama' => 'Nama',
            'nip' => 'Nip',

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
    public function getLelangRisalahs()
    {
        return $this->hasMany(LelangRisalah::className(), ['id_pl' => 'id']);
    }
}
