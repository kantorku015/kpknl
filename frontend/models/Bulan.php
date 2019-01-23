<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bulan".
 *
 * @property string $id_bulan
 * @property string $nama
 */
class Bulan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bulan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bulan', 'nama'], 'required'],
            [['id_bulan'], 'string', 'max' => 2],
            [['nama'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bulan' => 'Id Bulan',
            'nama' => 'Nama',
        ];
    }
}
