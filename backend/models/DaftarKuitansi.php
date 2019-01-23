<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "daftar_kuitansi".
 *
 * @property string $kuitansi_no
 * @property string $id_rl
 * @property string $rl_no
 * @property int $tahun
 */
class DaftarKuitansi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'daftar_kuitansi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rl_no'], 'required'],
            [['tahun'], 'integer'],
            [['kuitansi_no'], 'string', 'max' => 5],
            [['id_rl', 'rl_no'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kuitansi_no' => 'Kuitansi No',
            'id_rl' => 'Id Rl',
            'rl_no' => 'Rl No',
            'tahun' => 'Tahun',
        ];
    }
}
