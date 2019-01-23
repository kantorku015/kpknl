<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "stakeholder_status".
 *
 * @property integer $id
 * @property string $ur_status
 *
 * @property KpknlStakeholder[] $kpknlStakeholders
 */
class StakeholderStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stakeholder_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ur_status'], 'required'],
            [['id'], 'integer'],
            [['ur_status'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ur_status' => 'Ur Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKpknlStakeholders()
    {
        return $this->hasMany(KpknlStakeholder::className(), ['jenis' => 'id']);
    }
}
