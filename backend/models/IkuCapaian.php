<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "iku_capaian".
 *
 * @property int $id
 * @property int $id_pic
 * @property double $capaian_q1
 * @property double $capaian_q2
 * @property double $capaian_q3
 * @property double $capaian_q4
 *
 * @property IkuPic $pic
 */
class IkuCapaian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iku_capaian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_pic'], 'required'],
            [['id', 'id_pic'], 'integer'],
            [['capaian_q1', 'capaian_q2', 'capaian_q3', 'capaian_q4'], 'number'],
            [['id'], 'unique'],
            [['id_pic'], 'exist', 'skipOnError' => true, 'targetClass' => IkuPic::className(), 'targetAttribute' => ['id_pic' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPic()
    {
        return $this->hasOne(IkuPic::className(), ['id' => 'id_pic']);
    }
}
