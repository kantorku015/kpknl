<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bkpn_proses".
 *
 * @property int $id
 * @property string $nrpn
 * @property int $id_proses
 * @property string $tgl_proses
 * @property string $keterangan
 *
 * @property Bkpn $nrpn0
 * @property BkpnProsesRef $proses
 */
class BkpnProses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bkpn_proses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nrpn', 'id_proses', 'tgl_proses', /*'keterangan'*/], 'required'],
            [['id', 'id_proses'], 'integer'],
            [['tgl_proses'], 'safe'],
            [['keterangan'], 'string'],
            [['nrpn'], 'string', 'max' => 20],
            [['id'], 'unique'],
            [['nrpn'], 'exist', 'skipOnError' => true, 'targetClass' => Bkpn::className(), 'targetAttribute' => ['nrpn' => 'nrpn']],
            [['id_proses'], 'exist', 'skipOnError' => true, 'targetClass' => BkpnProsesRef::className(), 'targetAttribute' => ['id_proses' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nrpn' => 'Nrpn',
            'id_proses' => 'Id Proses',
            'tgl_proses' => 'Tgl Proses',
            'keterangan' => 'Keterangan',
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
    public function getProses()
    {
        return $this->hasOne(BkpnProsesRef::className(), ['id' => 'id_proses']);
    }
}
