<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lelang_obyek_kab_kota".
 *
 * @property int $id
 * @property string $nama_kab_kota
 *
 * @property LelangObyek[] $lelangObyeks
 */
class LelangObyekKabKota extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_obyek_kab_kota';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nama_kab_kota'], 'required'],
            [['id'], 'integer'],
            [['nama_kab_kota'], 'string', 'max' => 100],
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
            'nama_kab_kota' => 'Nama Kab Kota',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLelangObyeks()
    {
        return $this->hasMany(LelangObyek::className(), ['kab_kota' => 'id']);
    }
}
