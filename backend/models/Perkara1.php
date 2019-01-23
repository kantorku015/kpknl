<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "perkara1".
 *
 * @property int $id
 * @property string $no_perkara
 * @property string $tempat
 * @property string $tahun
 * @property string $nama_penggugat
 * @property string $posisi_kpknl
 * @property int $status
 * @property string $no_box
 * @property string $ket
 * @property int $created_by
 * @property string $created_at
 * @property int $updated_by
 * @property string $updated_at
 */
class Perkara1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perkara1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_perkara', 'tempat', 'tahun', 'nama_penggugat', 'posisi_kpknl'], 'required'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['ket'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['no_perkara', 'posisi_kpknl'], 'string', 'max' => 100],
            [['tempat'], 'string', 'max' => 20],
            [['tahun'], 'string', 'max' => 4],
            [['nama_penggugat'], 'string', 'max' => 200],
            [['no_box'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_perkara' => 'No Perkara',
            'tempat' => 'Tempat',
            'tahun' => 'Tahun',
            'nama_penggugat' => 'Nama Penggugat',
            'posisi_kpknl' => 'Posisi Kpknl',
            'status' => 'Status',
            'no_box' => 'No Box',
            'ket' => 'Ket',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }
}
