<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bkpn_pinjam".
 *
 * @property integer $id
 * @property string $nrpn
 * @property string $peminjam
 * @property string $tgl_pinjam
 * @property string $tgl_kembali
 * @property string $keterangan
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property Bkpn $nrpn0
 * @property User $createdBy
 * @property User $updatedBy
 */
class BkpnPinjam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bkpn_pinjam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nrpn', 'peminjam', 'tgl_pinjam'], 'required'],
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['tgl_pinjam', 'tgl_kembali', 'created_at', 'updated_at'], 'safe'],
            [['keterangan'], 'string'],
            [['nrpn', 'peminjam'], 'string', 'max' => 20],
            [['nrpn'], 'exist', 'skipOnError' => true, 'targetClass' => Bkpn::className(), 'targetAttribute' => ['nrpn' => 'nrpn']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nrpn' => 'NRPN',
            'peminjam' => 'Peminjam',
            'tgl_pinjam' => 'Tgl Pinjam',
            'tgl_kembali' => 'Tgl Kembali',
            'keterangan' => 'Keterangan',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNrpn0()
    {
        return $this->hasOne(Bkpn::className(), ['nrpn' => 'nrpn']);
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
}
