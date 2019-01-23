<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "perkara".
 *
 * @property string $no_perkara
 * @property string $tempat
 * @property string $tahun
 * @property string $nama_penggugat
 * @property string $posisi_kpknl
 * @property string $no_box
 * @property string $ket
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property PerkaraPinjam $perkaraPinjam
 */
class Perkara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perkara';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_perkara', 'tempat', 'tahun', 'nama_penggugat', 'posisi_kpknl'], 'required'],
            [['ket'], 'string'],
            [['status','created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['no_perkara', 'posisi_kpknl'], 'string', 'max' => 100],
            [['tempat'], 'string', 'max' => 20],
            [['tahun'], 'string', 'max' => 4],
            [['nama_penggugat'], 'string', 'max' => 200],
            [['no_box'], 'string', 'max' => 10],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => PerkaraStatus::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'no_perkara' => 'No Perkara',
            'tempat' => 'Tempat',
            'tahun' => 'Tahun',
            'nama_penggugat' => 'Nama Penggugat',
            'posisi_kpknl' => 'Posisi KPKNL',
            'status' => 'Status',
            'no_box' => 'No Box',
            'ket' => 'Ket',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerkaraPinjams()
    {
        return $this->hasMany(PerkaraPinjam::className(), ['no_perkara' => 'no_perkara']);
    }
    public function getStatus0()
    {
        return $this->hasOne(PerkaraStatus::className(), ['id' => 'status']);
    }
}
