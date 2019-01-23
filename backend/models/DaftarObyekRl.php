<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "daftar_obyek_rl".
 *
 * @property int $id
 * @property string $rl_no
 * @property int $tahun
 */
class DaftarObyekRl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'daftar_obyek_rl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'tahun'], 'integer'],
            [['rl_no'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rl_no' => 'Rl No',
            'tahun' => 'Tahun',
        ];
    }
}
