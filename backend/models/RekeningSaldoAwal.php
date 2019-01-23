<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rekening_saldo_awal".
 *
 * @property int $id
 * @property string $jns_trn
 * @property double $jumlah
 * @property string $tgl
 * @property string $keterangan
 *
 * @property RekeningJenisTrn $jnsTrn
 */
class RekeningSaldoAwal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rekening_saldo_awal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[/*'id',*/ 'jns_trn', 'jumlah', 'tgl', /*'keterangan'*/], 'required'],
            [['id'], 'integer'],
            [['jumlah'], 'number'],
            [['tgl'], 'safe'],
            [['keterangan'], 'string'],
            [['jns_trn'], 'string', 'max' => 10],
            [['id'], 'unique'],
            [['jns_trn'], 'exist', 'skipOnError' => true, 'targetClass' => RekeningJenisTrn::className(), 'targetAttribute' => ['jns_trn' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jns_trn' => 'Jns Trn',
            'jumlah' => 'Jumlah',
            'tgl' => 'Tgl',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJnsTrn()
    {
        return $this->hasOne(RekeningJenisTrn::className(), ['id' => 'jns_trn']);
    }
}
