<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "iku_target_header".
 *
 * @property int $id
 * @property int $id_pic
 * @property double $target_q1
 * @property double $target_q2
 * @property double $target_q3
 * @property double $target_q4
 * @property int $id_header
 */
class IkuTargetHeader extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iku_target_header';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_pic', 'id_header'], 'required'],
            [['id', 'id_pic', 'id_header'], 'integer'],
            [['target_q1', 'target_q2', 'target_q3', 'target_q4'], 'number'],
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
            'id_header' => 'Id Header',
        ];
    }
}
