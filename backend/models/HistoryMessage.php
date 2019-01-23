<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "history_message".
 *
 * @property int $id
 * @property int $id_header
 * @property int $id_detail
 * @property string $created_at
 * @property int $created_by
 */
class HistoryMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_header', 'id_detail', 'created_at', 'created_by'], 'required'],
            [['id', 'id_header', 'id_detail', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
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
            'id_header' => 'Id Header',
            'id_detail' => 'Id Detail',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
}
