<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bkpn".
 *
 * @property string $nrpn
 * @property string $ph_nama
 * @property string $pp_nama
 * @property double $nilai_penyerahan
 * @property string $keterangan
 * @property integer $no_box
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property User $updatedBy
 * @property User $createdBy
 * @property BkpnPinjam[] $bkpnPinjams
 */
class Bkpn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bkpn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nrpn', 'ph_nama', 'pp_nama', 'nilai_penyerahan'], 'required'],
            [['nilai_penyerahan'], 'number'],
            [['keterangan'], 'string'],
            [['no_box', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nrpn'], 'string', 'max' => 20],
            [['ph_nama', 'pp_nama'], 'string', 'max' => 200],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nrpn' => 'Nrpn',
            'ph_nama' => 'Ph Nama',
            'pp_nama' => 'Pp Nama',
            'nilai_penyerahan' => 'Nilai Penyerahan',
            'keterangan' => 'Keterangan',
            'no_box' => 'No Box',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
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
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBkpnPinjams()
    {
        return $this->hasMany(BkpnPinjam::className(), ['nrpn' => 'nrpn']);
    }
}
