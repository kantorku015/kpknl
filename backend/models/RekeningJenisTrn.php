<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rekening_jenis_trn".
 *
 * @property string $id
 * @property string $jns_rek
 * @property string $m_k
 * @property string $ur_trn
 * @property int $hak_negara
 * @property string $idx1
 * @property string $idx2
 *
 * @property RekeningPenerimaan[] $rekeningPenerimaans
 * @property RekeningSaldoAwal[] $rekeningSaldoAwals
 */
class RekeningJenisTrn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rekening_jenis_trn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jns_rek', 'm_k', 'ur_trn', 'idx1', 'idx2'], 'required'],
            [['hak_negara'], 'integer'],
            [['id'], 'string', 'max' => 10],
            [['jns_rek', 'idx1', 'idx2'], 'string', 'max' => 5],
            [['m_k'], 'string', 'max' => 1],
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
            'idx1' => 'Idx1',
            'idx2' => 'Idx2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRekeningPenerimaans()
    {
        return $this->hasMany(RekeningPenerimaan::className(), ['jns_trn' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRekeningSaldoAwals()
    {
        return $this->hasMany(RekeningSaldoAwal::className(), ['jns_trn' => 'id']);
    }
}
