<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "iku_target".
 *
 * @property int $id
 * @property int $id_pic
 * @property double $target_q1
 * @property double $target_q2
 * @property double $target_q3
 * @property double $target_q4
 *
 * @property IkuPic $pic
 */
class IkuTarget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iku_target';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_pic'], 'required'],
            [['id', 'id_pic'], 'integer'],
            [['target_q1', 'target_q2', 'target_q3', 'target_q4'], 'number'],
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
            'target_q1' => 'Target Q1',
            'target_q2' => 'Target Q2',
            'target_q3' => 'Target Q3',
            'target_q4' => 'Target Q4',
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
