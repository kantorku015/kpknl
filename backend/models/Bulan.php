<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bulan".
 *
 * @property string $kd_bulan
 * @property string $ur_bulan
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
            [['kd_bulan', 'ur_bulan'], 'required'],
            [['kd_bulan'], 'string', 'max' => 2],
            [['ur_bulan'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kd_bulan' => 'Kd Bulan',
            'ur_bulan' => 'Ur Bulan',
        ];
    }
}
