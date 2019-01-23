<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "request_header".
 *
 * @property integer $id
 * @property string $no_dokumen
 * @property string $tgl_dok
 * @property integer $id_layanan
 * @property string $tgl_terima
 * @property string $ticket_code
 * @property string $keterangan
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property KpknlLayanan $idLayanan
 * @property User $createdBy
 * @property User $updatedBy
 */
class RequestHeader extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_header';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'no_dokumen', 'tgl_dok', 'id_layanan', 'tgl_terima', 'ticket_code', /*'keterangan'*/], 'required'],
            [['id', 'id_layanan', 'created_by', 'updated_by'], 'integer'],
            [['tgl_dok', 'tgl_terima', 'created_at', 'updated_at'], 'safe'],
            [['keterangan'], 'string'],
            [['no_dokumen'], 'string', 'max' => 100],
            [['ticket_code'], 'string', 'max' => 10],
            [['no_dokumen', 'ticket_code'], 'unique', 'targetAttribute' => ['no_dokumen', 'ticket_code'], 'message' => 'The combination of No Dokumen and Ticket Code has already been taken.'],
            [['id_layanan'], 'exist', 'skipOnError' => true, 'targetClass' => KpknlLayanan::className(), 'targetAttribute' => ['id_layanan' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => KpknlStakeholder::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_dokumen' => 'No Dokumen',
            'id_stakeholder' => 'Nama Pemohon',
            'tgl_dok' => 'Tgl Dokumen',
            'id_layanan' => 'Nama Layanan',
            'tgl_terima' => 'Tgl Terima',
            'ticket_code' => 'Ticket Code',
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
    public function getIdLayanan()
    {
        return $this->hasOne(KpknlLayanan::className(), ['id' => 'id_layanan']);
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
    public function getId0()
    {
        return $this->hasOne(KpknlStakeholder::className(), ['id' => 'id']);
    }
}
