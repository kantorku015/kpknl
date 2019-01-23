<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lelang_pemenang".
 *
 * @property integer $id
 * @property string $nama_pemenang
 * @property string $alamat_pemenang
 *
 * @property LelangObyek[] $lelangObyeks
 */
class LelangPemenang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_pemenang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nama_pemenang', 'alamat_pemenang'], 'required'],
            [['id'], 'integer'],
            [['alamat_pemenang'], 'string'],
            [['nama_pemenang'], 'string', 'max' => 100],

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
            'nama_pemenang' => 'Nama Pemenang',
            'alamat_pemenang' => 'Alamat Pemenang',

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
        return $this->hasMany(LelangObyek::className(), ['id_pemenang' => 'id']);
    }
}
