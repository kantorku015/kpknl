<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tiket_seksi".
 *
 * @property string $ticket_code
 * @property string $tgl_terima
 * @property int $status
 * @property int $id_seksi
 */
class TiketSeksi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tiket_seksi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ticket_code', 'tgl_terima', 'id_seksi'], 'required'],
            [['tgl_terima'], 'safe'],
            [['id_seksi'], 'integer'],
            [['ticket_code'], 'string', 'max' => 10],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ticket_code' => 'Ticket Code',
            'tgl_terima' => 'Tgl Terima',
            'status' => 'Status',
            'id_seksi' => 'Id Seksi',
        ];
    }
}
