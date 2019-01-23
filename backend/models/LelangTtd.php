<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lelang_ttd".
 *
 * @property integer $id
 * @property string $nama
 * @property string $nip
 * @property string $jabatan
 * @property string $status
 */
class LelangTtd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_ttd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nama', 'nip', 'jabatan', 'status'], 'required'],
            [['id'], 'integer'],
            [['nama', 'jabatan'], 'string', 'max' => 100],
            [['nip'], 'string', 'max' => 20],
            [['status'], 'string', 'max' => 10],

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
            'jabatan' => 'Jabatan',
            'status' => 'Status',

             //tambahan
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }
}
