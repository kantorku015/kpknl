<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "iku_capaian_header".
 *
 * @property int $id
 * @property int $id_pic
 * @property double $capaian_q1
 * @property double $capaian_q2
 * @property double $capaian_q3
 * @property double $capaian_q4
 * @property int $seksi_pic
 * @property string $porsi_pic
 * @property int $id_header
 */
class IkuCapaianHeader extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iku_capaian_header';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_pic', 'seksi_pic', 'porsi_pic', 'id_header'], 'required'],
            [['id', 'id_pic', 'seksi_pic', 'id_header'], 'integer'],
            [['capaian_q1', 'capaian_q2', 'capaian_q3', 'capaian_q4', 'porsi_pic'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pic' => 'Id Pic',
            'capaian_q1' => 'Capaian Q1',
            'capaian_q2' => 'Capaian Q2',
            'capaian_q3' => 'Capaian Q3',
            'capaian_q4' => 'Capaian Q4',
            'seksi_pic' => 'Seksi Pic',
            'porsi_pic' => 'Porsi Pic',
            'id_header' => 'Id Header',
        ];
    }
}
