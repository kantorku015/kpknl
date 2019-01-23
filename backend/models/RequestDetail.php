<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "request_detail".
 *
 * @property integer $id
 * @property integer $id_req_header
 * @property integer $id_proses
 * @property string $tgl_proses
 * @property string $keterangan
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property RequestHeader $idReqHeader
 * @property KpknlLayananProses $idProses
 * @property User $createdBy
 * @property User $updatedBy
 */
class RequestDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_req_header', 'id_proses', 'tgl_proses', /*'keterangan',*/ /*'created_by', 'created_at', 'updated_by', 'updated_at'*/], 'required'],
            [['id', 'id_req_header', 'id_proses', 'created_by', 'updated_by'], 'integer'],
            [['tgl_proses', 'created_at', 'updated_at'], 'safe'],
            [['keterangan'], 'string'],
            [['id_req_header'], 'exist', 'skipOnError' => true, 'targetClass' => RequestHeader::className(), 'targetAttribute' => ['id_req_header' => 'id']],
            [['id_proses'], 'exist', 'skipOnError' => true, 'targetClass' => KpknlLayananProses::className(), 'targetAttribute' => ['id_proses' => 'id']],
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
            'id_req_header' => 'ID Permohonan',
            'id_proses' => 'Uraian Proses',
            'tgl_proses' => 'Tanggal Proses',
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
    public function getIdReqHeader()
    {
        return $this->hasOne(RequestHeader::className(), ['id' => 'id_req_header']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProses()
    {
        return $this->hasOne(KpknlLayananProses::className(), ['id' => 'id_proses']);
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
