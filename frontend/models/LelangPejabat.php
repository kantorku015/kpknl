<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "lelang_pejabat".
 *
 * @property integer $id
 * @property string $nama
 * @property string $nip
 *
 * @property LelangHeader[] $lelangHeaders
 */
class LelangPejabat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_pejabat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nama', 'nip'], 'required'],
            [['id'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['nip'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'nip' => 'Nip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLelangHeaders()
    {
        return $this->hasMany(LelangHeader::className(), ['pejabat' => 'id']);
    }
}
