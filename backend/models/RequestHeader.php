<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "request_header".
 *
 * @property int $id
 * @property string $no_dokumen
 * @property int $id_stakeholder
 * @property string $tgl_dok
 * @property int $id_layanan
 * @property string $tgl_terima
 * @property string $ticket_code
 * @property string $keterangan
 * @property int $created_by
 * @property string $created_at
 * @property int $updated_by
 * @property string $updated_at
 *
 * @property RequestDetail[] $requestDetails
 * @property KpknlLayanan $layanan
 * @property User $createdBy
 * @property User $updatedBy
 * @property KpknlStakeholder $stakeholder
 * @property RequestRespon[] $requestRespons
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
            [['id', 'no_dokumen', 'id_stakeholder', 'tgl_dok', 'id_layanan', 'tgl_terima', 'ticket_code'], 'required'],
            [['id', 'id_stakeholder', 'id_layanan', 'created_by', 'updated_by'], 'integer'],
            [['tgl_dok', 'tgl_terima', 'created_at', 'updated_at'], 'safe'],
            [['keterangan'], 'string'],
            [['no_dokumen'], 'string', 'max' => 100],
            [['ticket_code'], 'string', 'max' => 10],
            [['status'], 'string', 'max' => 1],
            [['no_dokumen', 'ticket_code'], 'unique', 'targetAttribute' => ['no_dokumen', 'ticket_code']],
            [['id'], 'unique'],
            [['id_layanan'], 'exist', 'skipOnError' => true, 'targetClass' => KpknlLayanan::className(), 'targetAttribute' => ['id_layanan' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['id_stakeholder'], 'exist', 'skipOnError' => true, 'targetClass' => KpknlStakeholder::className(), 'targetAttribute' => ['id_stakeholder' => 'id']],
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
            'id_stakeholder' => 'Nama Stakeholder',
            'tgl_dok' => 'Tgl Dok',
            'id_layanan' => 'Nama Layanan',
            'tgl_terima' => 'Tgl Terima',
            'ticket_code' => 'Ticket Code',
            'keterangan' => 'Keterangan',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestDetails()
    {
        return $this->hasMany(RequestDetail::className(), ['id_req_header' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLayanan()
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStakeholder()
    {
        return $this->hasOne(KpknlStakeholder::className(), ['id' => 'id_stakeholder']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestRespons()
    {
        return $this->hasMany(RequestRespon::className(), ['ticket_code' => 'ticket_code']);
    }
}
