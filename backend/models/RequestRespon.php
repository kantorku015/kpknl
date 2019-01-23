<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "request_respon".
 *
 * @property int $id
 * @property string $ticket_code
 * @property int $id_respon
 * @property string $comment
 * @property string $tgl_respon
 *
 * @property RequestHeader $ticketCode
 * @property RequestResponRef $respon
 */
class RequestRespon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_respon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ticket_code', 'id_respon'], 'required'],
            [['id', 'id_respon'], 'integer'],
            [['comment'], 'string'],
            [['tgl_respon'], 'safe'],
            [['ticket_code'], 'string', 'max' => 10],
            [['id'], 'unique'],
            [['ticket_code'], 'exist', 'skipOnError' => true, 'targetClass' => RequestHeader::className(), 'targetAttribute' => ['ticket_code' => 'ticket_code']],
            [['id_respon'], 'exist', 'skipOnError' => true, 'targetClass' => RequestResponRef::className(), 'targetAttribute' => ['id_respon' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_code' => 'Kode Tiket',
            'id_respon' => 'Id Respon',
            'comment' => 'Komentar',
            'tgl_respon' => 'Tgl Respon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketCode()
    {
        return $this->hasOne(RequestHeader::className(), ['ticket_code' => 'ticket_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespon()
    {
        return $this->hasOne(RequestResponRef::className(), ['id' => 'id_respon']);
    }
}
