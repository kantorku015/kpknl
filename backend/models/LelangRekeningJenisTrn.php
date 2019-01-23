<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lelang_rekening_jenis_trn".
 *
 * @property string $id
 * @property string $jns_rek
 * @property string $m_k
 * @property string $ur_trn
 * @property int $hak_negara
 *
 * @property LelangRekening[] $lelangRekenings
 */
class LelangRekeningJenisTrn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_rekening_jenis_trn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jns_rek', 'm_k', 'ur_trn'], 'required'],
            [['hak_negara'], 'integer'],
            [['id'], 'string', 'max' => 10],
            [['jns_rek', 'm_k'], 'string', 'max' => 1],
            [['ur_trn'], 'string', 'max' => 100],
            [['ur_trn'], 'unique'],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jns_rek' => 'Jns Rek',
            'm_k' => 'M K',
            'ur_trn' => 'Ur Trn',
            'hak_negara' => 'Hak Negara',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLelangRekenings()
    {
        return $this->hasMany(LelangRekening::className(), ['jns_trn' => 'id']);
    }
}
